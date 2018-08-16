<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
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