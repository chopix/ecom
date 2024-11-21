<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php'; // Adjust the path as needed
require __DIR__.'/bootstrap/app.php'; // Adjust the path as needed

// Set up connection to the other database
DB::connection('bundledseo_amember');

// Fetch users from the other database
$usersFromOtherDatabase = DB::table('am_user')->get();
$migratedPassword = '';
$userPassword = '';

foreach ($usersFromOtherDatabase as $user) 
{
    if ($user->user_id == 11771)
    {
        $userPassword = $user->password;
        $migratedPassword = Hash::make(crypt($user->password, ''));
        
    }

}

echo "Password migration completed successfullyy. --> $userPassword -- > $migratedPassword  \n" ;
