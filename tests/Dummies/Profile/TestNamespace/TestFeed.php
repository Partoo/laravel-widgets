<?php

namespace Partoo\Widgets\Test\Dummies\Profile\TestNamespace;

use Partoo\Widgets\AbstractWidget;

class TestFeed extends AbstractWidget
{
    protected $slides = 6;

    public function run()
    {
        return 'Feed was executed with $slides = ' . $this->slides;
    }
}
