<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaySubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_subscriber', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_id');
            $table->enum('daily_preference', ['0', '1'])->default('0');
            $table->enum('weekly_preference', ['0', '1'])->default('0');
            $table->enum('monthly_preference', ['0', '1'])->default('0');
            $table->enum('active', ['0', '1'])->default('1');
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
        Schema::drop('holiday_subscriber');
    }
}
