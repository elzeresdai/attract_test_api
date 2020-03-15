<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_messages', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('to_user_id')->unsigned();
            $table->bigInteger('messages_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('to_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('messages_id')->references('id')->on('messages')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_messages');
    }
}
