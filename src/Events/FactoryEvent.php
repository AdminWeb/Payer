<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 16/08/18
 * Time: 12:04
 */

namespace AdminWeb\Payer\Events;


class FactoryEvent
{
    static public function get($event)
    {
        $events = [
            PendentEvent::EVENT => new PendentEvent(),
            PaidEvent::EVENT => new PaidEvent(),
            CancelledEvent::EVENT => new CancelledEvent(),
            ApprovedEvent::EVENT => new ApprovedEvent()
        ];
        if (!in_array($event, $events)) {
            throw new EventException('Unknow Event');
        }
        return $events["{$event}"];
    }
}