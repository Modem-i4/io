<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->decimal('price');
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->timestamp('end_date')->nullable();


//            $table->foreign('item_id')->references('id')->on('inventory_items');
//            $table->foreign('invoice_id')->references('id')->on('inventory_invoices');
//            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_licenses');
    }
}
