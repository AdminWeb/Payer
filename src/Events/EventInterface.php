<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 16/08/18
 * Time: 12:07
 */

namespace AdminWeb\Payer\Events;

interface EventInterface
{
    const PAID = 'PAID';

    const CANCELLED = 'CANCELLED';

    const APPROVED = 'APPROVED';

    const PENDENT = 'PENDENT';
}