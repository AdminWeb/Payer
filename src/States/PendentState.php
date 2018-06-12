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
    const STATE = self::PENDENT;

    public function __toString()
    {
        return self::STATE;
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