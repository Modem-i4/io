<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->date('date');
            $table->integer('provider_id')->unsigned();
            $table->text('file_url');
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('inventory_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_invoices');
    }
}
