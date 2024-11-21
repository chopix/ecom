<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Tool;
use App\Models\Package;
use App\Models\Product;
use App\Facades\CartFacade;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($request->productId);
        $productIsInCart = Cart::where('user_id', auth()->id())
                                ->where('product_id', $productId)->exists();

        if($product->productable->is_active && !$productIsInCart) {
            $cart = Cart::create([
                'product_id' => $productId,
                'user_id' => auth()->id(),
            ]);   
        }

        return back();
    }

    public function remove(Request $request) 
    {
        $productId = $request->productId;

        Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();

        CartFacade::loadCartItems();

        return back();
    }

    public function sessionReload()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
        ]);
    }
}
