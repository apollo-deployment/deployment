<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDeploymentPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deployment_plans', function (Blueprint $table) {
            $table->string('status')->nullable()->after('repository_branch');
            $table->integer('build_id')->unsigned()->nullable()->after('status');

            $table->foreign('build_id')->references('id')->on('builds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deployment_plans', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign('deployment_plans_build_id_foreign');
            $table->dropColumn('build_id');
        });
    }
}
