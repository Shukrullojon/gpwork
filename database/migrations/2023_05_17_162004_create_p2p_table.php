<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateP2pTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p2p', function (Blueprint $table) {
            $table->id();
            $table->string('ext_id',100);
            $table->string('sender',100);
            $table->tinyInteger('senderType');
            $table->bigInteger('senderAmount');
            $table->string('receiver',16);
            $table->tinyInteger('receiverType')->nullable();
            $table->string('merchant',50)->nullable();
            $table->string('terminal',50)->nullable();
            $table->string('payment_id',100)->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('credit_amount');
            $table->bigInteger('percentage_amount');
            $table->tinyInteger('is_transaction')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('p2p');
    }
}
