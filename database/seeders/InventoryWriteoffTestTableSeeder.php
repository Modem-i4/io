<?php

namespace Database\Seeders;

use App\Models\InventoryWriteoff;
use Illuminate\Database\Seeder;

class InventoryWriteoffTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryWriteoff::factory(100)->create();
    }
}
