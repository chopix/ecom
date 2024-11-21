<?php

namespace App\Console\Commands;

use App\Models\User;
use TCG\Voyager\Models\Role;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Assign admin role to a user';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $adminRole = Role::where('name', 'admin')->first();
        $user->role_id = $adminRole->id;
        $user->save();

        $this->info("Admin role assigned to {$email} successfully.");
    }
}
