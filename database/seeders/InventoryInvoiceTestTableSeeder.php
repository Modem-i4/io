<?php

namespace Database\Seeders;

use App\Models\InventoryInvoice;
use Illuminate\Database\Seeder;

class InventoryInvoiceTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryInvoice::factory(200)->create();
    }
}
