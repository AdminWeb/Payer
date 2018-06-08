<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 30/05/18
 * Time: 11:38
 */

namespace AdminWeb\Payer\Tests;

use AdminWeb\Payer\PayerServiceProvider;
use AdminWeb\Payer\States\StateInterface;
use AdminWeb\Payer\Tests\Fixtures\User;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase;

class PayerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->artisan('migrate', ['--database' => 'testing']);
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            PayerServiceProvider::class
        ];
    }

    /**
     * @test
     */
    public function SubscriptionsCanBeCreated()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $user->createSubscription('teste')->start();
        $this->assertCount(1, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
    }

    /**
     * @test
     *
     */
    public function getSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $this->assertCount(1, $user->getSubscription()->get());
        $this->assertEquals(StateInterface::Pendent, $user->getSubscription()->get()->first()->status);
        $this->assertTrue($sub->isPending());
    }

    /**
     * @test
     * @cover Subscription::approve
     */
    public function ApproveSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $this->assertCount(1, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
        $sub->approve();
        $this->assertCount(0, $user->getPendentsSubscriptions()->get());
        $this->assertCount(1, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
        $this->assertTrue($sub->isApproved());
    }

    /**
     * @test
     * @cover Subscription::cancel
     */
    public function CancelSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $this->assertCount(1, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
        $sub->cancel();
        $this->assertCount(0, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(1, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
        $this->assertTrue($sub->isCancelled());
    }

    /**
     * @test
     * @cover Subscription::pay
     */
    public function PaySubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $this->assertCount(1, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(0, $user->getPaidSubscriptions()->get());
        $sub->pay();
        $this->assertCount(0, $user->getPendentsSubscriptions()->get());
        $this->assertCount(0, $user->getApprovedSubscriptions()->get());
        $this->assertCount(0, $user->getCancelledSubscriptions()->get());
        $this->assertCount(1, $user->getPaidSubscriptions()->get());
        $this->assertTrue($sub->isPaid());
    }

    /**
     * @test
     * @cover Subscription::onTrial
     */
    public function AddTrialPeriod()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start(Carbon::now());
        $this->assertTrue($sub->onTrial());
    }

    /**
     * @test
     * @cover Subscription
     */
    public function CancellApprovedSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->approve();
        $sub->cancel();
        $this->assertTrue($sub->isCancelled());
    }

    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnApproveCancelledSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->cancel();
        $sub->approve();
    }

    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnPayCancelledSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->cancel();
        $sub->pay();
    }
    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnCancelPaidSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->cancel();
        $sub->pay();
    }

    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnApprovePaidSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->cancel();
        $sub->approve();
    }

    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnCancellCancelledSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->cancel();
        $sub->cancel();
    }
    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnApproveApprovedSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->approve();
        $sub->approve();
    }
    /**
     * @test
     * @cover Subscription
     * @expectedException \AdminWeb\Payer\States\StateException
     */
    public function ThrowExceptionOnPayPaidSubscription()
    {
        $user = User::create([
            'email' => 'igor@igor.com',
            'name' => 'Igor de Paula',
            'password' => '123'
        ]);
        $sub = $user->createSubscription('teste')->start();
        $sub->pay();
        $sub->pay();
    }
}

