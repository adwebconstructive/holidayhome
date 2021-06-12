<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReservantionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['canceled_at']);
            $table->string('cancelled_at')->default(null)->after('transaction_id');
            $table->unsignedBigInteger('cancelled_by')->default(null)->after('cancelled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('canceled_at')->nullable()->default(null);
            $table->dropColumn('canceled_by');
        });
    }
}
