<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $input;
    public $submitted = false;

    public function mount()
    {
        if (session()->has('last_reset_mail_sent') && now()->diffInMinutes(session('last_reset_mail_sent')) < 5) {
            $this->submitted = true;
        }
    }

    public function submit()
    {
        $this->validate(['input' => 'required']);

        if (session()->has('last_reset_mail_sent') && now()->diffInMinutes(session('last_reset_mail_sent')) < 5) {
            return $this->addError('input', 'Please wait for 5 minutes before trying again.');
        }


        $field = filter_var($this->input, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user = User::where($field, $this->input)->first();

        if (!$user) {
            return $this->addError('input', 'User not found');;
        }

        $status = Password::sendResetLink(['email' => $user->email]);

        session(['last_reset_mail_sent' => now()]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.auth', ['title' => 'Forgot password']);
    }
}
