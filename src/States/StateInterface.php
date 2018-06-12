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
    const PAID = 'PAID';

    const CANCELLED = 'CANCELLED';

    const APPROVED = 'APPROVED';

    const PENDENT = 'PENDENT';

    public function pay();

    public function approve();

    public function cancel();
}