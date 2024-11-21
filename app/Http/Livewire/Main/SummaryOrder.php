<?php

namespace App\Http\Livewire\Main;

use App\Models\Cart;
use Livewire\Component;
use App\Http\Resources\CartResource;

class SummaryOrder extends Component
{
    public $items = [];
    public $totalPrice = 0;
    public $highestPrice = 0;

    public function mount()
    {
        $this->items = CartResource::collection(
            Cart::where('user_id', auth()->id())
                ->with('product.productable.prices')
                ->get()
        )->toArray(request());


        $this->totalPrice = collect($this->items)->sum(function ($item) {
            return (float) $item['product']['price']; // Cast to float
        });
        
        $this->highestPrice = collect($this->items)->max(function ($item) {
            return (float) $item['product']['price']; // Cast to float
        });
    }   

    public function render()
    {
        return view('livewire.main.summary-order')->layout('components.layouts.dash', ['title' => 'Summary order']);
    }
}
