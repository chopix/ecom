<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;
use App\Models\AffiliateLink;

class AffiliateSales extends Component
{
    public $sales;

    public function mount()
    {
        $this->sales = AffiliateLink::where('user_id', auth()->id())
                                    ->with('affiliateSales.payment')
                                    ->get()
                                    ->pluck('affiliateSales')
                                    ->flatten()
                                    ->sortByDesc('created_at')->values()->all();
    }

    public function render()
    {
        return view('livewire.main.affiliate-sales')->layout('components.layouts.affiliate', ['title' => 'Affiliate Dashboard', 'navItem' => 'sales']);
    }
}
