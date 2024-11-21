<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PlanSubscription;
use App\Jobs\SubscriptionExpiryJob;

class ResetAllJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subs = PlanSubscription::where('active', true)->get();

        $subs->each(function($sub) {
            SubscriptionExpiryJob::dispatch($sub)->delay($sub->expires_at);
        });

        return Command::SUCCESS;
    }
}
