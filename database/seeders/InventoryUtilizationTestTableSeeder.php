<?php

namespace Database\Seeders;

use App\Models\InventoryUtilization;
use Illuminate\Database\Seeder;

class InventoryUtilizationTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryUtilization::factory(200)->create();
    }
}
