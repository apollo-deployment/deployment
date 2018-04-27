<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepoInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->integer('user_id')->after('name')->unsigned();
            $table->string('owner')->after('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('owner');
        });
    }
}
