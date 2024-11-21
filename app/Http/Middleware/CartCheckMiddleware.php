<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use App\Facades\CartFacade;
use Illuminate\Http\Request;

class CartCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        CartFacade::loadCartItems();

        return $next($request);
    }
}
