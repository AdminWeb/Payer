<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 30/05/18
 * Time: 12:07
 */

namespace AdminWeb\Payer\States;

interface StateInterface
{
    const Paid = 'PAID';

    const Cancelled = 'CANCELLED';

    const Approved = 'APPROVED';

    const Pendent = 'PENDENT';

    public function pay();

    public function approve();

    public function cancel();
}