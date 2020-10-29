<?php

namespace Database\Seeders;

use App\Models\InventoryProvider;
use Illuminate\Database\Seeder;

class InventoryProviderTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryProvider::factory(200)->create();
    }
}
