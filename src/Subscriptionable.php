<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 30/05/18
 * Time: 12:12
 */

namespace AdminWeb\Payer;

use AdminWeb\Payer\Itemable\ItemableInterface;
use AdminWeb\Payer\States\StateInterface;
use DateTime;

trait Subscriptionable
{
    public function createSubscription($name, ItemableInterface $item, DateTime $trial = null, DateTime $end = null)
    {
        $subscription = new SubscriptionBuilder($this, $trial, $end);
        $subscription->setPlan($name)
            ->setItem($item)
            ->setName($name);
        return $subscription;
    }

    public function getApprovedSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::APPROVED);
    }

    public function getPendentsSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::PENDENT);
    }

    public function getCancelledSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::CANCELLED);
    }

    public function getPaidSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::PAID);
    }

    public function getSubscription()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->latest();
    }
}