<?php

namespace Database\Seeders;

use App\Models\InventoryLicense;
use Illuminate\Database\Seeder;

class InventoryLicenseTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryLicense::factory(200)->create();
    }
}
