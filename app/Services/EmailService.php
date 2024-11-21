<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class EmailService
{
  public function sendEmails($users, callable $createMailable)
  {
    foreach($users as $user) { 
      $mailable = $createMailable($user);

      Mail::to($user->email)->queue($mailable);
    }
  }
}