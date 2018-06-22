<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 17/06/18
 * Time: 12:11
 */

namespace AdminWeb\Payer;


interface SubscriptionInterface
{
    public function fill(array $attributes);
}