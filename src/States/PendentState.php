<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:59
 */

namespace AdminWeb\Payer\States;


class PendentState extends AbstractState
{
    const State = self::Pendent;

    public function __toString()
    {
        return self::State;
    }

    public function approve()
    {
        return new ApprovedState();
    }

    public function cancel()
    {
        return new CancelledState();
    }

    public function pay()
    {
        return new PaidState();
    }
}