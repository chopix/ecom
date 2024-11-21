<?php

namespace App\Http\Livewire\Main;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $submittedVerification = false;

    public function mount()
    {
        if (session()->has('last_verification_mail_sent') && now()->diffInMinutes(session('last_verification_mail_sent')) < 5) {
            $this->submittedVerification = true;
        }
    }

    public function verifyEmail()
    {
        $user = User::find(auth()->id());

        $user->sendEmailVerificationNotification();

        session(['last_verification_mail_sent' => now()]);

        $this->submittedVerification = true;
    }

    public function render()
    {
        return view('livewire.main.profile')->layout('components.layouts.dash', ['title' => 'Profile']);
    }
}
