<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\AffiliateLink;
use App\Models\AffiliateClick;

class Register extends Component
{
    public function mount(Request $request)
    {
        if($request->has('affiliate_key')) {
            AffiliateClick::create([
                'affiliate_link_id' => AffiliateLink::where('affiliate_link', $request->input('affiliate_key'))->first()->id,
                'ip' => $request->ip(),
            ]);

            session(['affiliate_key' => $request->input('affiliate_key')]);

            return redirect()->route('auth.register');
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.auth', ['title' => 'Create Account']);
    }
}
