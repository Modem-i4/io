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

        $this->call(UsersTableSeeder::class);
        $this->call(InventoryDepartmentsTableSeeder::class);
        $this->call(InventoryTypesTableSeeder::class);
        $this->call(InventoryStatusesTableSeeder::class);

        //TODO: Create seeders for testing
    }

    private function truncate()
    {
        \Schema::disableForeignKeyConstraints();

        \App\Models\User::truncate();
        \App\Models\InventoryDepartment::truncate();
        \App\Models\InventoryType::truncate();

        \Schema::enableForeignKeyConstraints();
    }
}
