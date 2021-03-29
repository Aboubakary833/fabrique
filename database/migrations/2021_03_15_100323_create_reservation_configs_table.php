<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_configs', function (Blueprint $table) {
            $table->id('reservationConfigId');
            $table->integer('reservationNum');
            $table->date('reservationBegin');
            $table->date('reservationEnd');
            $table->json('reservationPeriod');
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
        Schema::dropIfExists('reservation_configs');
    }
}
