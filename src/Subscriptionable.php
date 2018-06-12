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
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::Approved);
    }

    public function getPendentsSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::Pendent);
    }

    public function getCancelledSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::Cancelled);
    }

    public function getPaidSubscriptions()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->where('status', StateInterface::Paid);
    }

    public function getSubscription()
    {
        return Subscription::where('subscriptionable_id', $this->id)->where('subscriptionable_type', get_class($this))->latest();
    }
}