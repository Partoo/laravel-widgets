<?php

namespace Partoo\Widgets\Test;

use Partoo\Widgets\Test\Support\TestApplicationWrapper;
use Partoo\Widgets\Test\Support\TestCase;
use Partoo\Widgets\WidgetGroup;
use Partoo\Widgets\WidgetGroupCollection;

class WidgetGroupCollectionTest extends TestCase
{
    /**
     * @var WidgetGroupCollection
     */
    protected $collection;

    public function setUp()
    {
        $this->collection = new WidgetGroupCollection(new TestApplicationWrapper());
    }

    public function testItGrantsAccessToWidgetGroup()
    {
        $groupObject = $this->collection->group('sidebar');

        $expectedObject = new WidgetGroup('sidebar', new TestApplicationWrapper());

        $this->assertEquals($expectedObject, $groupObject);
    }
}
