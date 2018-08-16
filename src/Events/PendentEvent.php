<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 16/08/18
 * Time: 11:59
 */

namespace AdminWeb\Payer\Events;


class PendentEvent extends AbstractEvent
{
    const EVENT = self::PENDENT;

    const CODE = 0;

    public function __toString()
    {
        return self::EVENT;
    }

}