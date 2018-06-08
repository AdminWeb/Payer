<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:58
 */

namespace AdminWeb\Payer\States;


class PaidState extends AbstractState
{
    const State = self::Paid;

    public function __toString()
    {
        return self::State;
    }
}