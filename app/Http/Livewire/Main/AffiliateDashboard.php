<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class AffiliateDashboard extends Component
{
    public function render()
    {
        return view('livewire.main.affiliate-dashboard')->layout('components.layouts.affiliate', ['title' => 'Affiliate Dashboard', 'navItem' => 'dashboard']);
    }
}
