<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AffiliateLink;
use App\Models\User;
use Illuminate\Support\Str;

class Affiliates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'affiliates:reset';

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
        $users = User::all();

        $users->each(function($user) {
            AffiliateLink::create([
                'user_id' => $user->id,
                'affiliate_link' => Str::random(20),
            ]);
        });

        return Command::SUCCESS;
    }
}
