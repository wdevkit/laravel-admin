<?php

namespace Wdevkit\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Wdevkit\Admin\Traits\AuthenticatesAdmins;
use Wdevkit\Admin\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesAdmins;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web_admin')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('wdevkit_admin::auth.login');
    }
}
