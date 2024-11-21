<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Facades\CartFacade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $user = $event->user;
        $currentSessionId = Session::getId();

        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '<>', $currentSessionId)
            ->delete();

        $user->last_login_at = now();
        $user->save();

        
        CartFacade::loadCartItems();
    }
}
