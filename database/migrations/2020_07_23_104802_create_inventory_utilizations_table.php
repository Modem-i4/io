<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryUtilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_utilizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->date('date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->text('file_url');
            $table->boolean('confirmed');

//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('provider_id')->references('id')->on('inventory_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_utilizations');
    }
}
