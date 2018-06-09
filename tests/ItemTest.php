<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09/06/18
 * Time: 11:35
 */

namespace AdminWeb\Payer\Tests;

use AdminWeb\Payer\Itemable\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * @covers \AdminWeb\Payer\Itemable\Item
     * @expectedException \AdminWeb\Payer\Itemable\ItemException
     */
    public function testSetQuantity()
    {
        new Item('teste', '0', '1');
    }

    /**
     * @covers \AdminWeb\Payer\Itemable\Item
     * @expectedException \AdminWeb\Payer\Itemable\ItemException
     */
    public function testSetAmount()
    {
        new Item('teste', '1', '0');
    }

    /**
     * @covers \AdminWeb\Payer\Itemable\Item
     */
    public function testSetNameException()
    {
        $item = new Item('teste', '1', '1');
        $this->assertEquals('teste', $item->getName());
    }

    /**
     * @covers \AdminWeb\Payer\Itemable\Item
     * @expectedException \AdminWeb\Payer\Itemable\ItemException
     */
    public function testSetName()
    {
        new Item(90857308950345, '1', '0');
    }

    public function testGetTotal()
    {
        $item = new Item('teste', '1', '5');
        $this->assertEquals(5, $item->getTotal());
        $item = new Item('teste', '1', '5.99');
        $this->assertEquals(5.99, $item->getTotal());
    }
}
