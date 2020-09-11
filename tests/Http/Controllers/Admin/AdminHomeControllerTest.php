<?php

namespace Wdevkit\Admin\Tests\Http\Controllers\Admin;

use Wdevkit\Admin\Tests\TestCase;

class AdminHomeControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(\Orchestra\Testbench\Http\Middleware\Authenticate::class, MockedMiddleware::class);
    }

    public function testGetAdminHomeRouteReturnsAdminHomePage()
    {
        $this->asAdmin()->get(route('wdevkit_admin.home'))->assertOk()->assertViewIs('wdevkit_admin::home');
    }

    public function testGetAdminHomeRouteRequiresAdminAuthentication()
    {
        $this->get(route('wdevkit_admin.home'))->assertRedirect(route('wdevkit_admin.login'));
    }
}

class MockedMiddleware extends \Orchestra\Testbench\Http\Middleware\Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('wdevkit_admin.login');
        }
    }
}

