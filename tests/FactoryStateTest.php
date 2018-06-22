<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 22/06/18
 * Time: 12:37
 */

namespace AdminWeb\Payer\Tests;
use AdminWeb\Payer\States\ApprovedState;
use AdminWeb\Payer\States\CancelledState;
use AdminWeb\Payer\States\FactoryState;
use AdminWeb\Payer\States\PaidState;
use AdminWeb\Payer\States\PendentState;
use PHPUnit\Framework\TestCase;

/**
 * Class FactoryStateTest
 * @package AdminWeb\Payer\Tests
 * @covers \AdminWeb\Payer\States\FactoryState
 */
class FactoryStateTest extends TestCase
{
    /**
     * @test
     *
     */
    public function PendentState()
    {
        $state = FactoryState::get('PENDENT');
        $this->assertInstanceOf(PendentState::class, $state);
    }/**
     * @test
     *
     */
    public function PaidState()
    {
        $state = FactoryState::get('PAID');
        $this->assertInstanceOf(PaidState::class, $state);
    }/**
     * @test
     *
     */
    public function CancelledState()
    {
        $state = FactoryState::get('CANCELLED');
        $this->assertInstanceOf(CancelledState::class, $state);
    }/**
     * @test
     *
     */
    public function ApprovedState()
    {
        $state = FactoryState::get('APPROVED');
        $this->assertInstanceOf(ApprovedState::class, $state);
    }
    /**
     * @test
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function throwExceptionState()
    {
        $state = FactoryState::get('RETURNED');
        $this->assertInstanceOf(ApprovedState::class, $state);
    }

}
