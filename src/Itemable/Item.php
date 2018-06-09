<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09/06/18
 * Time: 11:27
 */

namespace AdminWeb\Payer\Itemable;


class Item implements ItemableInterface
{

    private $name, $quantity, $amount, $idItem = null;

    /**
     * Item constructor.
     * @param $name
     * @param $quantity
     * @param $amount
     */
    public function __construct($name, $quantity, $amount)
    {
        $this->setName($name);
        $this->setAmount($amount);
        $this->setQuantity($quantity);
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Item
     */
    public function setName($name)
    {
        if(!is_string($name)){
            throw new ItemException('The name of item must be a string!');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        if(!is_numeric($quantity) || $quantity <= 0){
            throw new ItemException('The quantity of item must be a number and greater than 0!');
        }
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return number_format($this->amount, 2);
    }

    /**
     * @param mixed $amount
     * @return Item
     */
    public function setAmount($amount)
    {
        if(!is_numeric($amount) || $amount == 0){
            throw new ItemException('The amount of item must be a number and greater than 0!');
        }
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return null
     */
    public function getidItem()
    {
        return $this->idItem;
    }

    /**
     * @param null $id
     * @return Item
     */
    public function setidItem($idItem)
    {
        $this->idItem = $idItem;
        return $this;
    }



    public function getTotal()
    {
        $total = $this->getAmount() * $this->getQuantity();
        return $total;
    }
}