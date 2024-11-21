<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Archive extends Component
{
    public function render()
    {
        return view('livewire.main.archive')->layout('components.layouts.dash', ['title' => 'Archive']);
    }
}
