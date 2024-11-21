<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

class Blog extends Component
{
    public function render()
    {
        return view('livewire.main.blog')->layout('components.layouts.dash', ['title' => 'Blog']);
    }
}
