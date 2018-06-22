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
            PendentState::STATE => new PendentState(),
            PaidState::STATE => new PaidState(),
            CancelledState::STATE => new CancelledState(),
            ApprovedState::STATE => new ApprovedState()
        ];
        if (!in_array($state, $states)) {
            throw new StateException('Unknow State');
        }
        return $states["{$state}"];
    }
}