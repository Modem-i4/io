<?php

namespace Database\Seeders;

use App\Models\InventoryRepair;
use Illuminate\Database\Seeder;

class InventoryRepairTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryRepair::factory(200)->create();
    }
}
