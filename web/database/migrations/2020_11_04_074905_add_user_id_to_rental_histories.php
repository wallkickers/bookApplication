<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToRentalHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_histories', function (Blueprint $table) {
            $table->BigInteger('user_id')->unsigned()->nullable();
        });
        Schema::table('rental_histories', function (Blueprint $table) {
            $table->BigInteger('user_id')->nullable(false)->change();
        });
        Schema::table('rental_histories', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_histories', function (Blueprint $table) {
            $table->dropForeign('rental_histories_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
