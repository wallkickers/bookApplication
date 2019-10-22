<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBookInformationToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('title_kana')->nullable();;
            $table->string('subtitle')->nullable();;
            $table->string('subtitle_kana')->nullable();;
            $table->string('isbn')->nullable();;
            $table->string('author')->nullable();;
            $table->string('author_kana')->nullable();;
            $table->string('publisher')->nullable();;
            $table->string('url')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('title_kana');
            $table->dropColumn('subtitle');
            $table->dropColumn('subtitle_kana');
            $table->dropColumn('isbn');
            $table->dropColumn('author');
            $table->dropColumn('author_kana');
            $table->dropColumn('publisher');
            $table->dropColumn('url');
        });
    }
}
