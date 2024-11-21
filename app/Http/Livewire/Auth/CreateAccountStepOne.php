<?php

namespace App\Http\Livewire\Auth;

use App\Models\Product;
use Livewire\Component;
use App\Http\Resources\ToolResource;
use App\Http\Resources\PackageResource;

class CreateAccountStepOne extends Component
{
    public $packages = [];
    public $tools = [];

    public function mount()
    {
        $this->tools = ToolResource::collection(Product::activeTools()->with('productable.prices')->get())->toArray(request());
        
        $this->packages = PackageResource::collection(Product::activePackages()->with('productable.prices')->get())->toArray(request());  

    }
    
    public function saveOrderSummary($tools, $packages)
    {
        session(['selected_tools' => []]);
        session(['selected_packages' => []]);
    }

    public function render()
    {
        return view('livewire.auth.create-account-step-one');
    }
}
