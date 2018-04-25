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
            $table->string('name');
            $table->integer('environment_id')->unsigned();
            $table->integer('repository_id')->unsigned();
            $table->string('branch');
            $table->string('deployed_version');
            $table->boolean('is_automatic');
            $table->longText('remote_path');
            $table->timestamps();

            $table->foreign('environment_id')->references('id')->on('environments');
            $table->foreign('repository_id')->references('id')->on('repositories');
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
