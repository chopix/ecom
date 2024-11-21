<?php

namespace App\Http\Controllers\Voyager;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\PlanSubscription;
use App\Jobs\SubscriptionExpiryJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PlanSubscriptionResource;

class UserManagementController extends Controller
{
    public function getUserData(string $id)
    {
        $user = User::find($id);

        return view("voyager::users.read", compact('user'));
    }

    public function blockUser(string $id) 
    {
        $user = User::find($id);
        $user->is_blocked = true;
        $user->save();

        return back();
    }

    public function unblockUser(string $id)
    {
        $user = User::find($id);
        $user->is_blocked = false;
        $user->save();

        return back();
    }

    public function create()
    {
        return view('voyager::users.create');
    }

    public function store(Request $request)
    {
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

        $user = User::create($data);

        if($request->has('send_welcome')) {
            Mail::to($user->email)->send(new WelcomeMail($user->name));
        }
        
        if($request->has('send_verify')) {
            $user->sendEmailVerificationNotification();
        }

        return redirect('/admin/users');
    }

    public function getAllUsers()
    {
        $users = User::paginate(50);

        return view('voyager::users.index', compact('users'));
    }

    public function searchUser(Request $request)
    {   
        $user = User::find($request->user_id);

        if(!$user) return back();

        return redirect()->route('voyager.users.show', $user->id);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $user->update($request->except('is_business'));

        $user->is_business = $request->has('is_business');
        $user->save();

        return back();
    }

    public function getProducts($id)
    {
        $products = PlanSubscriptionResource::collection(PlanSubscription::with('product.productable')->where('user_id', $id)->where('active', true)->get());
        
        return view("voyager::users.products.index", compact('products', 'id'));
    }

    public function updateProducts(Request $request, $id)
    {
        $products = PlanSubscription::where('user_id', $id)->get();

        foreach($request->products as $productId => $product) {
            $matchingProduct = $products->first(function ($item) use ($productId) {
                return $item->id == $productId;
            });
            
            if($matchingProduct) {
                $this->updateSubscription($matchingProduct, str_replace('T', ' ', $product['expires_at']));
            }
        }

        return back();
    }

    public function updateSubscription($product, $expires) 
    {   
        if($product->expires_at !== $expires) {
            $product->expires_at = $expires;
            $product->save();

            $delayInSeconds = now()->diffInSeconds($product->started_at);

            SubscriptionExpiryJob::dispatch($product)->delay($delayInSeconds);
        }

    }

    public function manageUserProducts($id)
    {
        $allProducts = Product::with('productable')->get();

        $allProducts->transform(function ($product) use ($id) {
            $sub = PlanSubscription::where('product_id', $product->id)
                            ->where('user_id', $id)
                            ->latest()
                            ->first();
            
            if (isset($sub->active) && $sub->active) {
                $product->is_available = true;
                $product->expires_at = $sub->expires_at;
            } else {
                $product->is_available = false;
                $product->expires_at = null;
            }

            return $product;
        });
        
        return view("voyager::users.products.manage", compact('allProducts', 'id'));
    }

    public function addProduct(Request $request, $id)
    {   
        if($request->datetime) {
            $expiryDate = Carbon::createFromFormat('Y-m-d', $request->datetime);
            
            $subscription = PlanSubscription::create([
                'user_id' => $id,
                'product_id' => $request->product_id,
                'started_at' => now(),
                'expires_at' => $expiryDate,
                'active' => true,
            ]);

            SubscriptionExpiryJob::dispatch($subscription)->delay($expiryDate);
        }


        return back();
    }   

    public function removeProduct(Request $request, $id)
    {
        PlanSubscription::where('user_id', $id)
                        ->where('product_id', $request->product_id)
                        ->delete(); 

        return back();
    }

    public function getAllSubs()
    {
        $subs = PlanSubscription::where('active', 1)->latest()->get();

        return view('voyager::subs.index', compact('subs'));
    }
}
