<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\AmUser;

class YourImportCommand extends Command
{
    protected $signature = 'your:import-command';
    protected $description = 'Description of your import command';

    public function handle()
    {
        $usersFromOtherDatabase = AmUser::on('bundledseo_amember')->get();
        $migratedPassword = '';
        $userPassword = '';

        foreach ($usersFromOtherDatabase as $user) {
            if ($user->user_id == 11771) 
            {
                $userPassword = $user->pass;
                $migratedPassword = Hash::make($user->pass);
                echo "Password migration completed successfullyy here. --> $userPassword -- > $migratedPassword  \n" ;
            }
        }

    }
}
