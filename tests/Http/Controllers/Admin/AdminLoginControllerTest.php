<?php

namespace Wdevkit\Admin\Tests\Http\Controllers\Admin;

use Closure;
use Wdevkit\Admin\Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AdminLoginControllerTest extends TestCase
{
    public function testGetAdminLoginRouteReturnsAdminLoginPage()
    {
        $this->get(route('wdevkit_admin.login'))->assertOk()->assertViewIs('wdevkit_admin::auth.login');
    }

    public function testPostAdminLoginRouteAuthenticatesAdmin()
    {
        $admin = \Database\Factories\AdminFactory::new()->create();

        $this->post(route('wdevkit_admin.login'), [
            'email' => $admin->email,
            'password' => 'password'
        ])->assertRedirect(route('wdevkit_admin.home'));

        $this->assertAuthenticatedAs($admin, 'web_admin');
    }

    public function testPostAdminLoginRouteWithWrongCredentials()
    {
        $admin = \Database\Factories\AdminFactory::new()->create();

        $this->post(route('wdevkit_admin.login'), [
            'email' => $admin->email,
            'password' => 'bad'
        ])->assertSessionHasErrors();

        $this->assertInvalidCredentials(['password'], 'web_admin');
    }

    public function testGetAdminLoginRouteRedirectsHomePageWhenAuthenticated()
    {
        $this->app->bind(\Orchestra\Testbench\Http\Middleware\RedirectIfAuthenticated::class, MockRedirectIfAuthenticated::class);

        $this->asAdmin()->get(route('wdevkit_admin.login'))->assertRedirect(route('wdevkit_admin.home'));
    }
}

class MockRedirectIfAuthenticated extends \Orchestra\Testbench\Http\Middleware\RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if ($guard == 'web_admin') {
                return redirect('/admin/home');
            }

            return \redirect('/home');
        }

        return $next($request);
    }
}

