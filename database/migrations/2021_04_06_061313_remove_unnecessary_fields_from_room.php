<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnnecessaryFieldsFromRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->dropColumn(['room_type', 'person_allowed', 'price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->string('room_type');
            $table->integer('person_allowed');
            $table->integer('price')->nullable()->default(Null);
        });
    }
}
