<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountToCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_to_cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_balance');
            $table->bigInteger('account_id');
            $table->bigInteger('card_balance');
            $table->bigInteger('card_id');
            $table->string('card_token',100);
            $table->bigInteger('amount');
            $table->tinyInteger('is_transaction')->nullable();
            $table->tinyInteger('status')->comment("0 -> check create, 1 -> account debit, 2 -> card credit");
            $table->string('uuid',100);
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
        Schema::dropIfExists('account_to_cards');
    }
}
