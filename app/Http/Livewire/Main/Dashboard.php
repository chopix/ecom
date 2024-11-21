<?php

namespace App\Http\Livewire\Main;

use App\Models\Tool;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\PlanSubscription;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\PlanSubscriptionResource;

class Dashboard extends Component
{
    public $packages = [];
    public $tools = [];
    public $payments = [];

    public function mount()
    {
        $this->packages = PlanSubscriptionResource::collection(
            PlanSubscription::where('user_id', auth()->id())
                ->whereHas('product', function ($query) {
                    $query->where('productable_type', Package::class);
                })
                ->with('product.productable', 'payments')
                ->get()
        )->toArray(request());

        $this->tools = PlanSubscriptionResource::collection(
            PlanSubscription::where('user_id', auth()->id())
                ->whereHas('product', function ($query) {
                    $query->where('productable_type', Tool::class);
                })
                ->with(['product.productable', 'payments'])
                ->orderByDesc('active')
                ->get()
        )->toArray(request());

        $combinedArray = array_merge($this->tools, $this->packages);

        $this->payments = collect($combinedArray)->flatMap(function ($subscription) {
            return collect($subscription['payments'])->map(function ($payment) use ($subscription) {
                return [
                    'payment' => $payment,
                    'product' => $subscription['product'],
                    'started_at' => $subscription['started_at'],
                    'expires_at' => $subscription['expires_at'],
                    'active' => $subscription['active'],
                    'created_at' => $payment['created_at'],
                ];
            });
        })->sortBy('created_at')->reverse()->values()->all();
    }

    public function render()
    {
        return view('livewire.main.dashboard')->layout('components.layouts.dash', ['title' => 'Dashboard']);
    }
}
