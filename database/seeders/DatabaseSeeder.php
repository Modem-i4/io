<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate();

        if(config('app.debug')) {
            $this->testingSeeds();
        }
        else {
            $this->productionSeeds();
        }
    }

    private function testingSeeds()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InventoryDepartmentsTableSeeder::class);
        $this->call(InventoryStatusesTableSeeder::class);
        $this->call(InventoryTypesTableSeeder::class);

        $this->call(InventoryModelTestTableSeeder::class);
        $this->call(InventoryProviderTestTableSeeder::class);
    }

    private function productionSeeds()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InventoryDepartmentsTableSeeder::class);
        $this->call(InventoryTypesTableSeeder::class);
        $this->call(InventoryStatusesTableSeeder::class);
    }

    private function truncate()
    {
        \Schema::disableForeignKeyConstraints();

        \App\Models\User::truncate();
        \App\Models\InventoryDepartment::truncate();
        \App\Models\InventoryProvider::truncate();
        \App\Models\InventoryStatus::truncate();
        \App\Models\InventoryType::truncate();

        \Schema::enableForeignKeyConstraints();
    }
}
