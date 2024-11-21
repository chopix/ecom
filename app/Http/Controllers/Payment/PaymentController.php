<?php

namespace App\Http\Controllers\Payment;

use App\Models\Cart;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
  public function payWithRazorpay()
  {
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    // dd(env("RAZORPAY_SECRET"));

    $cartItems = CartResource::collection(
      Cart::where('user_id', auth()->id())
        ->with('product.productable.prices')
        ->get()
        ->filter(function ($item) {
          return $item->product->productable->is_active;
        })
    )->toArray(request());

    ['productIds' => $productIds, 'totalCost' => $totalCost] = $this->getPaymentData($cartItems);

        $razorpay_order = $api->order->create([
            'receipt' => 'order_rcptid_11',
            'amount' => (int)($totalCost * 100), 
            'currency' => 'INR',
            'notes' => [
                'products' => $productIds,
                'email' => auth()->user()->email,
                'user_id' => auth()->user()->id,
            ],
        ]);

        

    return back()->with(compact('razorpay_order'));
  }

  protected function getPaymentData($cartItems)
  {
    $productIds = collect($cartItems)->map(function ($item) {
      return $item['product']['product_id'];
    })->implode(', ');

    $totalCost = collect($cartItems)->sum(function ($item): int|float {
      return (float)$item['product']['price'];
    });

    return [
      'productIds' => $productIds,
      'totalCost' => $totalCost
    ];
  }
  public function handleRazorpayWebhook(Request $request)
  {
    $signature = $request->header('X-Razorpay-Signature');
    $payload = $request->getContent();
    $secret = env('RAZORPAY_WEBHOOK_SECRET');

    if ($this->verifySignature($payload, $signature, $secret)) {
      $event = $request->input('event');

      if ($event === 'payment.captured') {
        // Handle successful payment
        Log::info('Payment captured successfully.', $request->all());
        // Add your logic to handle the payment success
      } else {
        // Handle other events
        Log::info('Received Razorpay webhook event: ' . $event, $request->all());
      }

      return response()->json(['status' => 'success']);
    } else {
      Log::error('Razorpay webhook signature verification failed.');
      return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }
  }

  private function verifySignature($payload, $signature, $secret)
  {
    $expectedSignature = hash_hmac('sha256', $payload, $secret);
    return hash_equals($expectedSignature, $signature);
  }
}
