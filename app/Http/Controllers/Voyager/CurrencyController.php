<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::orderBy('is_active', 'desc')->get();

        return view("voyager::currencies.index", compact('currencies'));
    }

    public function updateCurrencies(Request $request)
    {
        $activeCurrencies = $request->active_currencies ?? []; 

        if(!empty($activeCurrencies)) {
            Currency::query()->update(['is_active' => false]);

            Currency::whereIn('id', $activeCurrencies)->update(['is_active' => true]);
        }
        
        return back();
    }

}
