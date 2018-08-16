<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:44
 */

namespace AdminWeb\Payer\Events;


abstract class AbstractEvent implements EventInterface
{
    abstract public function __toString();
}