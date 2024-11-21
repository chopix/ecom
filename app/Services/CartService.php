<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function loadCartItems()
    {      
      if(session('cart')) session()->forget('cart');

      $cartItems = Cart::where('user_id', auth()->id())->get();
      
      if($cartItems->count()) {

        $cartData = $cartItems->map(function ($item) {
          return [
            'product_id' => $item->product_id,
          ];
        });

        session(['cart' => $cartData]);
      }
    }
}