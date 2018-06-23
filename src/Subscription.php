<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 30/05/18
 * Time: 12:09
 */

namespace AdminWeb\Payer;

use AdminWeb\Payer\Itemable\ItemableInterface;
use AdminWeb\Payer\States\ApprovedState;
use AdminWeb\Payer\States\CancelledState;
use AdminWeb\Payer\States\FactoryState;
use AdminWeb\Payer\States\PaidState;
use AdminWeb\Payer\States\PendentState;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model implements SubscriptionInterface
{
    private $reference_id;

    protected $fillable = ['subscriptionable_id','value', 'subscriptionable_type', 'status', 'name', 'transaction_id', 'reference_id', 'provider', 'plan', 'trial_end_at', 'end_at'];

    /**
     * @var \AdminWeb\Payer\Itemable\ItemableInterface
     */
    protected $item = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public function getStatusAttribute($value)
    {
        return FactoryState::get($value);
    }

    /**
     * @return ItemableInterface
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param \AdminWeb\Payer\Itemable\ItemableInterface $item
     * @return Subscription
     */
    public function setItem(ItemableInterface $item)
    {
        $this->item = $item;
        return $this;
    }

    public function approve()
    {
        $this->status = $this->status->approve();
        $this->save();
    }

    public function cancel()
    {
        $this->status = $this->status->cancel();
        $this->save();
    }

    public function pay()
    {
        $this->status = $this->status->pay();
        $this->save();
    }

    public function isPaid()
    {
        return $this->status == (new PaidState());
    }

    public function isCancelled()
    {
        return $this->status == (new CancelledState());
    }

    public function isApproved()
    {
        return $this->status == (new ApprovedState());
    }

    public function isPending()
    {
        return $this->status == (new PendentState());
    }

    public function hasTrial()
    {
        return !is_null($this->trial_end_at);
    }

    public function onTrial()
    {
        return ($this->hasTrial()) ?: ($this->trial_end_at < Carbon::now());
    }
}