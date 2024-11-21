<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\Tool;
use App\Models\User;
use App\Models\Package;
use App\Models\Product;
use App\Mail\WelcomeMail;
use App\Events\LoginEvent;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        session()->flash('password', $request->password);
        
        if(!$request->has('highload')) {
            return redirect()->back()->withInput()->withErrors(['highload' => 'Accept the user agreement.']);
        }

        session()->flash('current_step', 'step-1');

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|digits_between:10,20',
            'password' => 'required|string|min:8',
        ]);

        $businessData = [];

        if($request->has('is_business')) {
            session()->forget('current_step');
            session()->flash('current_step', 'step-2');

            $businessData = $request->validate([
                'full_name' => 'required|string|max:255',
                'vat_number' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'town_city' => 'required|string|max:255',
                'state_country' => 'required|string|max:255',
                'postcode' => 'required|string|max:255',
                'country' => 'required|string|max:255',
            ]);
            
            $businessData['is_business'] = true;
            $businessData['last_login_at'] = now();
        }
        
        $data['password'] = Hash::make($data['password']);

        $fullData = array_merge($data, $businessData); 

        $user = User::create($fullData);
        
        Auth::login($user);

        LoginEvent::dispatch($user);
        
        $this->sendMailAfterRegister($user);

        $selectedPackages = json_decode($request->selected_packages, true);
        $selectedTools = json_decode($request->selected_tools, true);

        
        if(!empty($selectedPackages) || !empty($selectedTools)) {
            $this->addToCartSelectedProducts($selectedPackages, $selectedTools);

            return redirect()->route('summaryOrder');
        } else {
            return redirect()->route('dashboard');
        }
        
    }

    protected function sendMailAfterRegister($user)
    {
        Mail::to($user->email)->send(new WelcomeMail($user->name));
    }

    public function addToCartSelectedProducts($packages, $tools)
    {
        $cartData = [];

        if(!empty($packages)) {
            foreach($packages as $package) {
                $product = Product::where('productable_id', $package['id'])->where('productable_type', Package::class)->first();

                $cartData[] = [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                ];
            }
        }

        if(!empty($tools)) {
            foreach($tools as $tool) {
                $product = Product::where('productable_id', $package['id'])->where('productable_type', Tool::class)->first();

                $cartData[] = [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                ];
            }
        }

        Cart::insert($cartData);
    }

    public function login(Request $request)
    {
        $login = $request->login;

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $creds = [$fieldType => $login, 'password' => $request->password];

        if(Auth::attempt($creds)) {
            $user = Auth::user();
            
            LoginEvent::dispatch($user);

            $this->checkIp($request);
            
            return redirect()->route('dashboard');
        } else {
            return back()->withInput()->withErrors(['login' => 'User not found']);
        }
        
    }

    protected function checkIp($request)
    {
        $ip = $request->ip();
        
        if(auth()->user()->ip !== $ip) {
            $agent = new Agent();
    
            $agent->setUserAgent($request->userAgent());
            $agent->setHttpHeaders($request->headers);
    
            $device = $agent->browser();
            $platform = $agent->platform();
            $date = now();
            
            User::find(auth()->id())->update([
                'ip' => $request->ip(),
            ]);
    
            auth()->user()->sendNewDeviceLoggedInNotification($ip, $device, $platform, $date);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
