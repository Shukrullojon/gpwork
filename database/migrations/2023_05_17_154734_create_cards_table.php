<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('number',16);
            $table->string('expire',4);
            $table->tinyInteger('type')->comment('0 -> for user, 1 -> for GP WORK');
            $table->string('owner',100);
            $table->bigInteger('balance');
            $table->string('phone',16);
            $table->string('pnfl',14);
            $table->string("pasport_series",2);
            $table->string("pasport_number",7);
            $table->string('token',100);
            $table->tinyInteger('status')->comment('1 -> active, 13 -> closed');
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
        Schema::dropIfExists('cards');
    }
}
