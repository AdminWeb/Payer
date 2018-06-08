<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:44
 */

namespace AdminWeb\Payer\States;


abstract class AbstractState implements StateInterface
{

    public function pay()
    {
        throw new StateException("Can't be paid");
    }

    public function approve()
    {
        throw new StateException("Can't be approved");
    }

    public function cancel()
    {
        throw new StateException("Can't be cancelled");
    }

    abstract public function __toString();
}