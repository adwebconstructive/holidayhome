<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('emp_id')->after('id');
     
            $table->string('role')->after('email')->default(2)->comment('1 is admin 2 is user');
            $table->bigInteger('phone_number')->after('email');
            $table->bigInteger('enable')->after('email')->nullable()->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['emp_id','role','phone_number','enable']);
            $table->dropSoftDeletes();

        });
    }
}
