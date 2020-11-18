<?php

namespace Database\Seeders;

use App\Models\InventoryTransfer;
use Illuminate\Database\Seeder;

class InventoryTransferTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryTransfer::factory(200)->create();
    }
}
