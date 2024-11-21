<?php

namespace App\Http\Livewire\Auth;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $this->email)
            ->first();

        if(!$record || !Carbon::parse($record->created_at)->addMinutes(60)->isFuture()) {
            $this->addError('email', 'Uncorrect token.');
        }

        $status = Password::reset(
            [
                'email' => $this->email,
                'token' => $this->token,
                'password' => $this->password,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                Auth::login($user);

                session()->forget('last_reset_mail_sent');
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('dashboard');
        } else {
            $this->addError('email', $status);
        }
    }


    public function render()
    {
        return view('livewire.auth.reset-password')->layout('components.layouts.auth', ['title' => 'Reset password']);
    }
}
