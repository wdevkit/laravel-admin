<?php

namespace Wdevkit\Admin\Tests\Commands;

use Wdevkit\Admin\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCreateCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCreateCommand()
    {
        $this->artisan('admin:create')
             ->expectsQuestion('Admin name', 'John Doe')
             ->expectsQuestion('Admin email', 'john@email.com')
             ->expectsQuestion('Admin password', '1234')
             ->expectsQuestion('Admin password confirmation', '1234')
             ->expectsOutput("Admin created successfully.")
             ->assertExitCode(0);

        $this->assertDatabaseHas('admins', [
            'name' => 'John Doe',
            'email' => 'john@email.com'
        ]);
    }

    public function testAdminCreateCommandOneline()
    {
        $this->artisan('admin:create "Bob Smith" bob@email.com 1234 1234')
            ->expectsOutput("Admin created successfully.")
            ->assertExitCode(0);
    }
}
