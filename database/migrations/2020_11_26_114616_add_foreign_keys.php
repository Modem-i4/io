<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_departments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('inventory_departments');
        });

        Schema::table('inventory_invoices', function (Blueprint $table) {
            $table->foreign('provider_id')->references('id')->on('inventory_providers');
        });

        Schema::table('inventory_licenses', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('inventory_types');
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('invoice_id')->references('id')->on('inventory_invoices');
            $table->foreign('owner_id')->references('id')->on('users');
        });

        Schema::table('inventory_repairs', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('provider_id')->references('id')->on('inventory_providers');
        });

        Schema::table('inventory_utilizations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('provider_id')->references('id')->on('inventory_providers');
        });

        Schema::table('inventory_writeoffs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('inventory_items', function (Blueprint $table) {
            $table->foreign('part_of')->references('id')->on('inventory_items');
            $table->foreign('type_id')->references('id')->on('inventory_types');
            $table->foreign('model_id')->references('id')->on('inventory_models');
            $table->foreign('department_id')->references('id')->on('inventory_departments');
            $table->foreign('sticker_id')->references('id')->on('inventory_licenses');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('inventory_statuses');
            $table->foreign('invoice_id')->references('id')->on('inventory_invoices');
            $table->foreign('writeoff_id')->references('id')->on('inventory_writeoffs');
            $table->foreign ('utilization_id')->references('id')->on('inventory_utilizations');
        });

        Schema::table('inventory_transfers', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
