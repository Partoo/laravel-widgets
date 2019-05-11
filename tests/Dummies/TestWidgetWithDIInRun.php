<?php

namespace Partoo\Widgets\Test\Dummies;

use Partoo\Widgets\AbstractWidget;

class TestWidgetWithDIInRun extends AbstractWidget
{
    public function run(TestMyClass $class)
    {
        return $class->foo;
    }

    public function placeholder()
    {
        return 'Placeholder here!';
    }
}

class TestMyClass
{
    public $foo = 'bar';
}
