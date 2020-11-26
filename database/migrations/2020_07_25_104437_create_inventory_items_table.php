<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('sticker_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->string('inventory_number')->nullable();
            $table->decimal('price');
            $table->integer('invoice_id')->unsigned();
            $table->timestamps();
            $table->date('deleted_at')->nullable(); //
            $table->boolean('has_parts')->nullable();
            $table->integer('part_of')->unsigned()->nullable();
            $table->integer('writeoff_id')->unsigned()->nullable();
            $table->integer('utilization_id')->unsigned()->nullable();


//            $table->foreign('part_of')->references('id')->on('inventory_items');
//            $table->foreign('type_id')->references('id')->on('inventory_types');
//            $table->foreign('model_id')->references('id')->on('inventory_models');
//            $table->foreign('department_id')->references('id')->on('inventory_departments');
//            $table->foreign('sticker_id')->references('id')->on('inventory_licenses');
//            $table->foreign('owner_id')->references('id')->on('users');
//            $table->foreign('status_id')->references('id')->on('inventory_statuses');
//            $table->foreign('invoice_id')->references('id')->on('inventory_invoices');
//            $table->foreign('writeoff_id')->references('id')->on('inventory_writeoffs');
//            $table->foreign ('utilization_id')->references('id')->on('inventory_utilizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}
