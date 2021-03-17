<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->string('room_number');
            $table->text('description')->nullable()->default(Null);
            $table->string('room_type');
            $table->integer('person_allowed');
            $table->integer('max_person_allowed');
            $table->integer('rate')->nullable()->default(Null);
            $table->integer('price')->nullable()->default(Null);
            $table->dateTime('deleted_at')->nullable()->default(Null);
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
        Schema::dropIfExists('hotel_rooms');
    }
}
