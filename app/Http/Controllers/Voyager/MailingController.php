<?php

namespace App\Http\Controllers\Voyager;

use App\Models\User;
use App\Models\Email;
use App\Mail\UserMail;
use App\Models\Product;
use App\Models\Currency;
use App\Facades\EmailFacade;
use App\Mail\NewArticleMail;
use Illuminate\Http\Request;
use App\Models\PlanSubscription;
use App\Mail\NewInstallationMail;
use App\Mail\ProductDiscountsMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{
    public function sendMailForm()
    {
        $products = Product::with(['subscriptions', 'productable'])->get();

        $emails = Email::orderByDesc('created_at')->paginate(20);

        return view("voyager::mailing.form", compact('products', 'emails'));
    }

    public function generatePreview(Request $request)
    {
        if(filter_var($request->recipient, FILTER_VALIDATE_INT) !== false) {
            $users = PlanSubscription::with('user')->where('product_id', $request->recipient)->get()->pluck('user');
        } else if($request->recipient === 'all') {
            $users = User::all();
        } else if($request->recipient === 'verified') {
            $users = User::whereNotNull('email_verified_at')->get();
        } 
        
        if(!empty($users)) {
            if($request->layout === 'new-product' && 
                $request->tools_included &&
                $request->htmlContent) {
                
                $product = Product::find($request->tools_included);
                
                session([
                    'mail' => [
                        'layout' => $request->layout,
                        'content' => $request->htmlContent,
                        'product' => $product,
                        'users' => $users, 
                    ],
                    'preview' => true,
                ]);

                return view('emails.new-installation', [
                    'user' => auth()->user(),
                    'product' => $product,
                    'content' => $request->htmlContent,
                ]);
            }

            if($request->layout === 'new-article' && $request->link && $request->htmlContent) {
                session([
                    'mail' => [
                        'layout' => $request->layout,
                        'content' => $request->htmlContent,
                        'link' => $request->link,
                        'users' => $users, 
                    ],
                    'preview' => true,
                ]);

                return view('emails.new-article', [
                    'link' => $request->link,
                    'content' => $request->htmlContent,
                    'user' => auth()->user(),
                ]);
            }

            if($request->layout === 'user' && $request->htmlContent && $request->subject) {
                session([
                    'mail' => [
                        'layout' => $request->layout,
                        'content' => $request->htmlContent,
                        'subject' => $request->subject,
                        'users' => $users, 
                    ],
                    'preview' => true,
                ]);

                return view('emails.user', [
                    'subject' => $request->subject,
                    'content' => $request->htmlContent,
                    'user' => auth()->user(),
                ]);
            }

            if($request->layout === 'discounts' && $request->htmlContent && !empty($request->discounts)) {
                $products = Product::with('productable')->findMany($request->discounts);

                $currenciesObj = Currency::all();

                $user = auth()->user();

                $curObj = $currenciesObj->first(function($currency) use ($user) {
                    return $currency->country === $user->location;
                });

                $newProducts = [];

                foreach($products as $product) {
                    $price = $product->productable->price;
                    $currencySymbol = '$';
        
                    if($curObj) {                               
                        $multiPrice = $product->productable->prices->firstWhere('country_code', $curObj->currency);
                        
                        if ($multiPrice && $multiPrice->price) {
                            $currencySymbol = $curObj->symbol;
                            $price = $multiPrice->price;
                        }
                    }
        
                    $productArray = $product->toArray();
                    $productArray['price'] = $price;
                    $productArray['currencySymbol'] = $currencySymbol;
                    $product = (object)$productArray;

                    $newProducts[] = $product;
                }

                session([
                    'mail' => [
                        'layout' => $request->layout,
                        'content' => $request->htmlContent,
                        'newProducts' => $newProducts,
                        'products' => $products,
                        'users' => $users, 
                    ],
                    'preview' => true,
                ]);

                return view('emails.discounts', [
                    'user' => auth()->user(),
                    'products' => $newProducts,
                    'content' => $request->htmlContent,
                ]);
            }
        }
        
        return back();
    }

    public function sendMail()
    {
        session()->forget('preview');

        $mail_data = session('mail');
        
        $users = $mail_data['users'];

        if($mail_data['layout'] === 'new-product') {
            EmailFacade::sendEmails($users, function($user) use ($mail_data){
                return new NewInstallationMail($mail_data['product'], $user, $mail_data['content']);
            });

            Email::create([
                'recipients' => json_encode($users->pluck('id')),
                'html_content' => view('emails.new-installation', [
                    'product' => $mail_data['product'],
                    'content' => $mail_data['content'],
                    'user' => auth()->user(),
                ])->render()
            ]);
        }
        
        if($mail_data['layout'] === 'user') {
            EmailFacade::sendEmails($users, function($user) use ($mail_data){
                return new UserMail($mail_data['subject'], $mail_data['content'], $user);
            });


            Email::create([
                'recipients' => json_encode($users->pluck('id')),
                'html_content' => view('emails.user', [
                    'subject' => $mail_data['subject'],
                    'content' => $mail_data['content'],
                    'user' => auth()->user(),
                ])->render()
            ]);
        }

        if($mail_data['layout'] === 'new-article') {
            EmailFacade::sendEmails($users, function($user) use ($mail_data){
                return new NewArticleMail($mail_data['link'], $mail_data['content'], $user);
            });
        }
        
        if($mail_data['layout'] === 'discounts') {          
            $this->sendDiscountsMail();
        }
        
        session()->forget('mail');

        return redirect()->route('mailing.form');
    }

    protected function sendDiscountsMail() 
    {
        $mail_data = session('mail');
        $users = $mail_data['users'];
        $content = $mail_data['content'];

        $currenciesObj = Currency::all();
        $products = $mail_data['products'];
        
        EmailFacade::sendEmails($users, function($user) use ($products, $currenciesObj, $content) {
            $curObj = $currenciesObj->first(function($currency) use ($user) {
                return $currency->country === $user->location;
            });
            
            $newProducts = [];
            
            foreach($products as $product) {
                $price = $product->productable->price;
                $currencySymbol = '$';
                
                if($curObj) {                               
                    $multiPrice = $product->productable->prices->firstWhere('country_code', $curObj->currency);
                    
                    if ($multiPrice && $multiPrice->price) {
                        $currencySymbol = $curObj->symbol;
                        $price = $multiPrice->price;
                    }
                }
                
                $productArray = $product->toArray();
                $productArray['price'] = $price;
                $productArray['currencySymbol'] = $currencySymbol;
                $product = (object)$productArray;
                
                $newProducts[] = $product;
            }
            
            return new ProductDiscountsMail($newProducts, $user, $content);
        });   

        Email::create([
            'recipients' => json_encode($users->pluck('id')),
            'html_content' => view('emails.discounts', [
                'products' => $mail_data['newProducts'],
                'content' => $mail_data['content'],
                'user' => auth()->user(),
            ])->render()
        ]);
    }

    public function showMail($id)
    {
        $email = Email::find($id);

        return view('voyager::mailing.show', ['content' => $email->html_content]);
    }
}
