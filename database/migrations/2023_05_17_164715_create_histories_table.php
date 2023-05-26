<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('date',20);
            $table->string('dtAcc',20);
            $table->string('dtAccName',50);
            $table->string('dtMfo',5);
            $table->string('purpose',250);
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('credit')->nullable();
            $table->string('numberTrans',20)->nullable();
            $table->tinyInteger('type');
            $table->string('ctAcc',20);
            $table->string('ctAccName',50);
            $table->string('ctMfo',5);
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
        Schema::dropIfExists('histories');
    }
}
