<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 12:33
 */


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscriptionable_id')->index();
            $table->string('subscriptionable_type')->index();
            $table->string('name')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('status')->default('PENDENT');
            $table->string('provider')->nullable();
            $table->string('plan')->nullable();
            $table->timestamp('trial_end_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}