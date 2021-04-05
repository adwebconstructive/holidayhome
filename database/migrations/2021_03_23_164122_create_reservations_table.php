<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserved_by')->nullable()->default(Null);
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('room_id');
            $table->date('from');
            $table->date('to');
            $table->string('rate');
            $table->unsignedBigInteger('transaction_id')->nullable()->default(Null);
            $table->dateTime('canceled_at')->nullable()->default(Null);
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
        Schema::dropIfExists('reservations');
    }
}
