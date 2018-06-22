<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:57
 */

namespace AdminWeb\Payer\States;


class CancelledState extends AbstractState
{

    const STATE = self::CANCELLED;

    const CODE = 3;

    public function __toString()
    {
        return self::STATE;
    }
}