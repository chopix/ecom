<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Support extends Component
{
    public function render()
    {
        return view('livewire.main.support')->layout('components.layouts.dash', ['title' => 'Support']);
    }
}
