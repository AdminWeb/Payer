<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:57
 */

namespace AdminWeb\Payer\Events;


class CancelledEvent extends AbstractEvent
{

    const EVENT = self::CANCELLED;

    const CODE = 3;

    public function __toString()
    {
        return self::EVENT;
    }
}