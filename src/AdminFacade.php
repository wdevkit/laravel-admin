<?php

namespace Wdevkit\Admin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wdevkit\Admin\Admin
 */
class AdminFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'admin';
    }
}
