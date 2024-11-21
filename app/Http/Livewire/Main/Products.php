<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;
use App\Models\PlanSubscription;

class Products extends Component
{
    public $plans = [];

    public function mount() 
    {
        $this->plans = PlanSubscription::with('product.productable')->get();
    }

    public function render()
    {
        return view('livewire.main.products')->layout('components.layouts.dash', ['title' => 'Products']);
    }
}
