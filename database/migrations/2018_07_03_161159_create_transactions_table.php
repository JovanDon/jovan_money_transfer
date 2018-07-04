<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount');
            $table->unsignedInteger('sender_account');
            $table->foreign('sender_account')->references('id')->on('accounts');
            $table->unsignedInteger('reciever_account');
            $table->foreign('reciever_account')->references('id')->on('accounts');
            $table->timestamp("Created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
