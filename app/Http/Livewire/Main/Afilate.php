<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Afilate extends Component
{
    public function render()
    {
        return view('livewire.main.afilate')->layout('components.layouts.dash', ['title' => 'Affiliate']);
    }
}
