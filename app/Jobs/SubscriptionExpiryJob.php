<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\PlanSubscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SubscriptionExpiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscription;

    
    public function __construct(PlanSubscription $subscription)
    {
        $this->subscription = $subscription;
    }


    public function handle()
    {
        if($this->subscription->expires_at <= now()) {
            $this->subscription->active = false;
            $this->subscription->save();
        }    
    }
}
