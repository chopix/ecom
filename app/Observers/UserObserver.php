<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Affiliate;
use Illuminate\Support\Str;
use App\Models\AffiliateLink;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        AffiliateLink::create([
            'user_id' => $user->id,
            'affiliate_link' => Str::random(30),
        ]);

        
        if(session('affiliate_key')) {
            $affLink = AffiliateLink::where('affiliate_link', session('affiliate_key'))->first();

            if($affLink) {
                Affiliate::create([
                    'affiliate_link_id' => $affLink->id,
                    'referred_user_id' => $user->id,
                ]);

                session()->forget('affiliate_key');
            }
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
