<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09/06/18
 * Time: 11:27
 */

namespace AdminWeb\Payer\Itemable;

use ArrayObject;

class ItemList implements ItemableInterface
{

    private $item = [];

    /**
     * ItemList constructor.
     * @param array $item
     */
    public function __construct(array $item = [])
    {
        if (count($item) > 0) {
            array_map([$this, 'validate'], $item);
        }
        $this->item = new ArrayObject($item);
    }

    public function addItem(ItemableInterface $item)
    {
        $this->item->append($item);
    }

    public function count()
    {
        return $this->item->count();
    }

    /**
     * @return ArrayObject
     */
    public function getItem(): ArrayObject
    {
        return $this->item;
    }

    /**
     * @param array $item
     */
    public function setItem(array $item): ItemList
    {
        array_map([$this, 'validate'], $item);
        $this->item = new ArrayObject($item);
        return $this;
    }


    protected function validate($item)
    {
        if (!$item instanceof ItemableInterface) {
            throw new ItemException(sprintf('The element must be %s type!', ItemableInterface::class));
        }
        return true;
    }

    public function getTotal()
    {
        return array_sum(array_map(function ($item) {
            return $item->getTotal();
        }, $this->item->getArrayCopy()));
    }
}