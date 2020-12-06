<?php

namespace Database\Seeders;

use App\Models\InventoryModel;
use Illuminate\Database\Seeder;

class InventoryModelTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryModel::factory(200)->create();
    }
}
