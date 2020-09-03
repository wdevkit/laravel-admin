<?php

namespace Webdk\Admin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Webdk\Admin\Admin
 */
class AdminFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'admin';
    }
}
