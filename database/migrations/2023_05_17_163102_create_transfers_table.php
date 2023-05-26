<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('ext_id',100);
            $table->string('sender',100);
            $table->tinyInteger('senderType');
            $table->bigInteger('senderAmount');
            $table->string('receiver',16);
            $table->bigInteger('amount');
            $table->bigInteger('credit_amount')->nullable();
            $table->bigInteger('debit_amount')->nullable();
            $table->bigInteger('commission_amount')->nullable();
            $table->string('currency',3)->nullable();
            $table->string('document_id')->nullable();
            $table->string('document_ext_id')->nullable();
            $table->float('rate')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('is_transaction')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
