<?php

namespace Partoo\Widgets;

class AsyncFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Partoo.async-widget';
    }
}
