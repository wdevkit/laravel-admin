<?php

namespace Wdevkit\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Wdevkit\Admin\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Returns admin home page response.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('wdevkit_admin::home');
    }
}
