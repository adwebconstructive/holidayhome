<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pin_code');
            $table->string('gstn')->nullable()->default(Null);
            $table->string('contact_person')->nullable()->default(Null);
            $table->string('contact_email')->nullable()->default(Null);
            $table->string('contact_phone')->nullable()->default(Null);
            $table->tinyInteger('enabled')->nullable()->default(1)->comment('0 disabled 1 enabled');
            $table->string('logo')->nullable()->default(Null);
            $table->string('deleted_at')->nullable()->default(Null);
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
        Schema::dropIfExists('hotels');
    }
}
