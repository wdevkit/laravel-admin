<?php

namespace Wdevkit\Admin\Commands;

use Wdevkit\Admin\Models\Admin;
use Illuminate\Console\Command;

class AdminCreateCommand extends Command
{
    public $signature = 'admin:create {name?} {email?} {password?} {password_confirmation?}';

    public $description = 'Create new admin';

    public function handle()
    {
        if (! $name = $this->argument('name')) {
            $name = $this->ask('Admin name');
        }

        if (! $email = $this->argument('email')) {
            $email = $this->ask('Admin email');
        }

        if (! $password = $this->argument('password')) {
            $password = $this->secret('Admin password');
        }

        if (! $passwordConfirmation = $this->argument('password_confirmation')) {
            $passwordConfirmation = $this->secret('Admin password confirmation');
        }

        if ($password !== $passwordConfirmation) {
            $this->error('Admin password confirmation does not match password.');
            return;
        }

        Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password)
        ]);

        $this->info('Admin created successfully.');
    }
}
