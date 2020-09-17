<?php

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
    }

    private function truncate()
    {
        Schema::disableForeignKeyConstraints();

        App\Models\User::truncate();
        App\Models\InventoryDepartment::truncate();

        Schema::enableForeignKeyConstraints();
    }
}
