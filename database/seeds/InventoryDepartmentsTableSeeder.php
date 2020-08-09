<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InventoryDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cName = 'Острозька академія';
        $categories[] = [
            'title'     => $cName,
            //'slug'      => Str::slug($cName),
            'parent_id' => 1,
        ];

        $categories[] = [
            'title'     => 'Головний корпус',
            'parent_id' => 1,
        ];

        $categories[] = [
            'title'     => 'Гуманітарний корпус',
            'parent_id' => 1,
        ];
        
        $categories[] = [
            'title'     => 'Наукова бібліотека',
            'parent_id' => 1,
        ];

        for ($i = 2; $i <=11; $i++) {
            $cName = 'Відділ #'.$i;
            $parentId = '2';

            $categories[] = [
            'title'     => $cName,
            'parent_id' => $parentId,
            ];
        }

        DB::table('inventory_departments')->insert($categories);
    }
}
