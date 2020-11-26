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
        \Schema::disableForeignKeyConstraints();

        $this->truncate();

        if(config('app.debug'))
            $this->testingSeeds();
        else
            $this->productionSeeds();

        \Schema::enableForeignKeyConstraints();
    }

    private function testingSeeds()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InventoryDepartmentsTableSeeder::class);
        $this->call(InventoryStatusesTableSeeder::class);
        $this->call(InventoryTypesTableSeeder::class);

        $this->call(InventoryInvoiceTestTableSeeder::class);
        $this->call(InventoryItemTestTableSeeder::class);
        $this->call(InventoryLicenseTestTableSeeder::class);
        $this->call(InventoryModelTestTableSeeder::class);
        $this->call(InventoryProviderTestTableSeeder::class);
        $this->call(InventoryRepairTestTableSeeder::class);
        $this->call(InventoryTransferTestTableSeeder::class);
        $this->call(InventoryUtilizationTestTableSeeder::class);
        $this->call(InventoryWriteoffTestTableSeeder::class);
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
        \App\Models\User::truncate();
        \App\Models\InventoryDepartment::truncate();
        \App\Models\InventoryInvoice::truncate();
        \App\Models\InventoryItem::truncate();
        \App\Models\InventoryLicense::truncate();
        \App\Models\InventoryModel::truncate();
        \App\Models\InventoryProvider::truncate();
        \App\Models\InventoryRepair::truncate();
        \App\Models\InventoryStatus::truncate();
        \App\Models\InventoryTransfer::truncate();
        \App\Models\InventoryType::truncate();
        \App\Models\InventoryUtilization::truncate();
        \App\Models\InventoryWriteoff::truncate();
    }
}
