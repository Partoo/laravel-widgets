<?php

namespace Partoo\Widgets;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Partoo.widget';
    }

    /**
     * Get the widget group object.
     *
     * @param $name
     *
     * @return WidgetGroup
     */
    public static function group($name)
    {
        return app('Partoo.widget-group-collection')->group($name);
    }
}
