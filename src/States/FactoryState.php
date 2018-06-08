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
            case StateInterface::Pendent == $state:
                $factoredState = new PendentState();
                break;
            case StateInterface::Paid == $state:
                $factoredState = new PaidState();
                break;
            case StateInterface::Cancelled == $state:
                $factoredState = new CancelledState();
                break;
            case StateInterface::Approved == $state:
                $factoredState = new ApprovedState();
                break;
        }
        return $factoredState;
    }
}