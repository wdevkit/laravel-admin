<?php

namespace Wdevkit\Admin\Tests;

use Wdevkit\Admin\Models\Admin;
use Wdevkit\Admin\AdminServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        // set admin user provider for tests
        $this->app->config->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => \Wdevkit\Admin\Models\Admin::class,
        ]);

        // set web_admin guard for tests
        $this->app->config->set('auth.guards.web_admin', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:BzHDKKl6Wuz3p+HY8Tz/61D8uCPD3PcqLlYbWOV1Hvs=');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);


        include_once __DIR__.'/../database/migrations/create_admins_table.php.stub';

        (new \CreateAdminsTable())->up();

    }

    /**
     * As admin helper method for tests.
     *
     * @param  Admin|null $admin
     * @param  string     $guard
     */
    public function asAdmin(Admin $admin = null, $guard = 'web_admin')
    {
        if (!$admin) {
            $admin = \Database\Factories\AdminFactory::new()->create();
        }

        return $this->actingAs($admin, $guard);
    }
}
