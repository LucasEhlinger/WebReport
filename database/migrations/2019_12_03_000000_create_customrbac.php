<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            /*customs*/
            $table->int('status');
        });

        Schema::create('command', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->int('resource_type'); // roles, projects, lot, activities.
            $table->string('command_name'); // read, write, create
        });

        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->int('parent_id')->nullable();
        });

        Schema::create('role_command', function (Blueprint $table) {
            $table->int('user_id');
            $table->int('role_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('role');
        });

        Schema::create('user_project_role', function (Blueprint $table) {
            $table->int('user_id');
            $table->int('project_id');
            $table->int('role_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('role');

            // todo
            if (Schema::hasTable('project')) {
                $table->foreign('project_id')->references('id')->on('project');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
