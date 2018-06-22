<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 12:04
 */

namespace AdminWeb\Payer\States;


class FactoryState
{
    static public function get($state)
    {
        $states = [
            PendentState::CODE => new PendentState(),
            PaidState::CODE => new PaidState(),
            CancelledState::CODE => new CancelledState(),
            ApprovedState::CODE => new ApprovedState()
        ];
        if (!array_key_exists($state, $states)) {
            throw new StateException('Unknow State');
        }
        return $states[$state];
    }
}