<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lot_id');
            $table->foreign('lot_id')->references('id')->on('lot');
            $table->string('description');
            $table->string('activity_key',4);
            $table->timestamp('theorical_start')->nullable();
            $table->timestamp('theorical_end')->nullable();
            $table->timestamp('real_start')->nullable();
            $table->timestamp('real_end')->nullable();
            $table->unsignedInteger('theorical_duration');
            $table->unsignedInteger('real_duration');
            $table->double('theorical_cost');
            $table->double('real_cost');
            $table->boolean('validation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity', function(Blueprint $table) {
            $table->dropForeign('lot_id_foreign');
        });

        Schema::dropIfExists('activity');
    }
}
