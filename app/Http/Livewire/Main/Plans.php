<?php

namespace App\Http\Livewire\Main;

use App\Models\Tool;
use App\Models\Package;
use App\Models\Product;
use Livewire\Component;
use App\Facades\CartFacade;
use App\Http\Resources\ToolResource;
use App\Http\Resources\PackageResource;

class Plans extends Component
{
    public $tools = [];
    public $packages = [];

    public function mount()
    {
        $this->tools = ToolResource::collection(Product::activeTools()->with('productable.prices')->get())->toArray(request());
        
        $this->packages = PackageResource::collection(Product::activePackages()->with('productable.prices')->get())->toArray(request());  
    }

    public function render()
    {
        return view('livewire.main.plans')->layout('components.layouts.dash', ['title' => 'Plans']);
    }
}
