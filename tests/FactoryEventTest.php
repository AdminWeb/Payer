<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 16/08/18
 * Time: 11:19
 */

namespace AdminWeb\Payer\Tests;

use AdminWeb\Payer\Events\ApprovedEvent;
use AdminWeb\Payer\Events\CancelledEvent;
use AdminWeb\Payer\Events\FactoryEvent;
use AdminWeb\Payer\Events\PaidEvent;
use AdminWeb\Payer\Events\PendentEvent;
use PHPUnit\Framework\TestCase;

class FactoryEventTest extends TestCase
{
    /**
     * @test
     *
     */
    public function PendentEvent()
    {
        $Event = FactoryEvent::get('PENDENT');
        $this->assertInstanceOf(PendentEvent::class, $Event);
    }

    /**
     * @test
     *
     */
    public function PaidEvent()
    {
        $Event = FactoryEvent::get('PAID');
        $this->assertInstanceOf(PaidEvent::class, $Event);
    }

    /**
     * @test
     *
     */
    public function CancelledEvent()
    {
        $Event = FactoryEvent::get('CANCELLED');
        $this->assertInstanceOf(CancelledEvent::class, $Event);
    }

    /**
     * @test
     *
     */
    public function ApprovedEvent()
    {
        $Event = FactoryEvent::get('APPROVED');
        $this->assertInstanceOf(ApprovedEvent::class, $Event);
    }

    /**
     * @test
     * @expectedException \AdminWeb\Payer\Events\EventException
     */
    public function throwExceptionEvent()
    {
        $Event = FactoryEvent::get('RETURNED');
        $this->assertInstanceOf(ApprovedEvent::class, $Event);
    }

}
