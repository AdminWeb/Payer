<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 11:17
 */

namespace AdminWeb\Payer;

use AdminWeb\Payer\States\StateInterface;
use DateTime;
use Illuminate\Support\Str;

class SubscriptionBuilder
{
    private $owner;
    private $transaction;
    private $reference;
    /**
     * @var StateInterface
     */
    private $status;
    private $provider;
    private $plan;
    /**
     * @var DateTime
     */
    private $trial;

    /**
     * @var DateTime
     */
    private $end;

    public function __construct($owner)
    {
        $this->setOwner($owner);
        $this->setReference();
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     * @return SubscriptionBuilder
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     * @return SubscriptionBuilder
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     * @return SubscriptionBuilder
     */
    public function setReference()
    {
        $this->reference = Str::uuid();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     * @return SubscriptionBuilder
     */
    public function setProvider($provider = null)
    {
        $this->provider = $provider ? $provider : env('DRIVER');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @param mixed $plan
     * @return SubscriptionBuilder
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTrial()
    {
        return $this->trial;
    }

    /**
     * @param DateTime $trial
     * @return SubscriptionBuilder
     */
    public function setTrial(DateTime $trial = null)
    {
        $this->trial = $trial;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param DateTime $end
     * @return SubscriptionBuilder
     */
    public function setEnd(DateTime $end = null)
    {
        $this->end = $end;
        return $this;
    }

    public function start(DateTime $trial = null, DateTime $end = null)
    {
        $this->setEnd($end);
        $this->setTrial($trial);
        $subscription = Subscription::create([
            'name' => $this->getName(),
            'plan' => $this->getPlan(),
            'provider' => $this->getProvider(),
            'reference_id' => $this->getReference(),
            'subscriptionable_id' => $this->getOwner()->id,
            'subscriptionable_type' => get_class($this->getOwner()),
            'trial_end_at' => $this->getTrial(),
            'end_at' => $this->getEnd()
        ]);
        return $subscription;
    }

}