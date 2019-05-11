<?php

namespace Partoo\Widgets\Test\Dummies;

use Partoo\Widgets\AbstractWidget;

class Exception extends AbstractWidget
{
    public function run()
    {
        return 'Exception widget was executed instead of predefined php class';
    }
}
