<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('project');
            $table->string('lot_key', 2);
            $table->timestamp('theorical_start')->nullable();
            $table->timestamp('theorical_end')->nullable();
            $table->timestamp('real_start')->nullable();
            $table->timestamp('real_end')->nullable();
            $table->double('theorical_cost');
            $table->double('real_cost');
            $table->boolean('close');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lot', function(Blueprint $table) {
            $table->dropForeign('project_id_foreign');
        });

        Schema::dropIfExists('lot');
    }
}
