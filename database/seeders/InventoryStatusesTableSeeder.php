<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Встановлено',
            ],
            [
                'title' => 'Передається',
            ],
            [
                'title' => 'В ремонті',
            ],
            [
                'title' => 'Не підлягає ремонту',
            ],
            [
                'title' => 'Пошкоджено',
            ],
            [
                'title' => 'Списано',
            ],
            [
                'title' => 'Утилізовано',
            ]
        ];
        DB::table('inventory_statuses')->insert($data);
    }
}
