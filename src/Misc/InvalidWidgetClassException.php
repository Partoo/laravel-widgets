<?php

namespace Partoo\Widgets\Misc;

use Exception;

class InvalidWidgetClassException extends Exception
{
    /**
     * Exception message.
     *
     * @var string
     */
    protected $message = 'Widget class must extend Partoo\Widgets\AbstractWidget class';
}
