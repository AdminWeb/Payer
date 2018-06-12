<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:56
 */

namespace AdminWeb\Payer\States;


class ApprovedState extends AbstractState
{

    const STATE = self::APPROVED;

    public function __toString()
    {
        return self::STATE;
    }

    public function cancel()
    {
        return new CancelledState();
    }
}