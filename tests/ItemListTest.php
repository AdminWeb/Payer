<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09/06/18
 * Time: 11:57
 */

namespace AdminWeb\Payer\Tests;

use AdminWeb\Payer\Itemable\Item;
use AdminWeb\Payer\Itemable\ItemList;
use PHPUnit\Framework\TestCase;


class ItemListTest extends TestCase
{

    /**
     * @covers \AdminWeb\Payer\Itemable\ItemList
     * @expectedException \AdminWeb\Payer\Itemable\ItemException
     */
    public function testSetItem()
    {
        $item = new Item('sofa', 1, '299');
        $itemList = new ItemList();
        $itemList->setItem([$item]);
        $itemList = new ItemList();
        $itemList->setItem(['asdasdasd']);
    }
    /**
     * @covers \AdminWeb\Payer\Itemable\ItemList
     */
    public function testAddItem()
    {
        $item1 = new Item('Tv', 1, '599');
        $itemList = new ItemList();
        $itemList->addItem($item1);
        $this->assertEquals(1, $itemList->count());
    }
    /**
     * @covers \AdminWeb\Payer\Itemable\ItemList
     */
    public function testGetTotal()
    {
        $item1 = new Item('Tv', 1, '599');
        $item2 = new Item('sofa', 2, '299');
        $itemList = new ItemList([$item1, $item2]);
        $this->assertEquals(1197, $itemList->getTotal());
    }

    /**
     * @covers \AdminWeb\Payer\Itemable\ItemList
     */
    public function testCount()
    {
        $item1 = new Item('Tv', 1, '599');
        $item2 = new Item('sofa', 1, '299');
        $itemList = new ItemList([$item1, $item2]);
        $this->assertEquals(2, $itemList->count());
        $this->assertEquals(2, $itemList->getItem()->count());
    }
}
