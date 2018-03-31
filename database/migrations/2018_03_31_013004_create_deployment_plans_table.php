<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeploymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployment_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_server_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('project_branch', 30);
            $table->integer('update_seconds')->default(0);
            $table->longText('storage_path');
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
        Schema::dropIfExists('deployment_plans');
    }
}
