<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 12:04
 */

namespace AdminWeb\Payer\States;


class FactoryState
{
    static public function get($state)
    {
        $factoredState = null;
        switch ($state) {
            case StateInterface::PENDENT == $state:
                $factoredState = new PendentState();
                break;
            case StateInterface::PAID == $state:
                $factoredState = new PaidState();
                break;
            case StateInterface::CANCELLED == $state:
                $factoredState = new CancelledState();
                break;
            case StateInterface::APPROVED == $state:
                $factoredState = new ApprovedState();
                break;
        }
        return $factoredState;
    }
}