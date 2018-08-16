<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 16/08/18
 * Time: 11:56
 */

namespace AdminWeb\Payer\Events;


class ApprovedEvent extends AbstractEvent
{

    const EVENT = self::APPROVED;

    const CODE = 4;

    public function __toString()
    {
        return self::EVENT;
    }

}