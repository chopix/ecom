<?php

namespace App\Http\Controllers\Payment;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Payment;
use App\Facades\CartFacade;
use Illuminate\Http\Request;
use App\Models\PlanSubscription;
use App\Jobs\SubscriptionExpiryJob;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PlanSubscriptionPayment;

class PaymentWebhookController extends Controller
{
    public function handleRazorpayCallback(Request $request)
    {
        // dd("ready");
                Log::info('Webhook received: ' . $request->getContent());
        $secret = env('RAZORPAY_WEBHOOK_SECRET');

        $razorpaySignature = $request->header('X-Razorpay-Signature');
        $body = $request->getContent();

        if(hash_hmac('sha256', $body, $secret) === $razorpaySignature) {
            $data = json_decode($body, true);
            $paymentData = $data['payload']['payment']['entity'];
            
            if($data['event'] === 'order.paid') {
                $payment = Payment::create([
                    'user_id' => $paymentData['notes']['user_id'],
                    'amount' => $paymentData['amount'] / 100,
                    'method' => $paymentData['method'],
                    'currency' => $paymentData['currency'],
                    'products' => json_encode(explode(", ", $paymentData['notes']['products'])),
                ]);
                
                
                $this->subscribeToPlans($payment, $paymentData);
            }
        } 

          return response()->json(['status' => 'success'], 200);
    }

    protected function subscribeToPlans($payment, $paymentData)
    {
        $userId = $paymentData['notes']['user_id'];
        $productsIds = explode(", ", $paymentData['notes']['products']);

        foreach($productsIds as $productId) {
            $subscription = PlanSubscription::where('active', true)
                                ->where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->where('active', true)
                                ->first();

            if ($subscription) {
                $newExpiryDate = Carbon::parse($subscription->expires_at)->addMonth();

                $subscription->update([
                    'expires_at' => $newExpiryDate,
                ]);
            } else {
                $subscription = PlanSubscription::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'started_at' => now(),
                    'expires_at' => now()->addMonth(),
                    'active' => true,
                ]);
            }

            PlanSubscriptionPayment::create([
                'plan_subscription_id' => $subscription->id,
                'payment_id' => $payment->id
            ]);

            SubscriptionExpiryJob::dispatch($subscription)->delay(now()->addMonth());

        }

        Cart::where('user_id', $userId)
            ->whereIn('product_id', $productsIds)
            ->delete();
    }
}
