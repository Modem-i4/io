<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryTypesTableSeeder extends Seeder
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
                        'title' => 'ПК',
                    ],
                    [
                        'title' => 'Монітор',
                    ],
                    [
                        'title' => 'Системний блок',
                    ],
                    [
                        'title' => 'Сервер',
                    ],
                    [
                        'title' => 'Проектор',
                    ],
                    [
                        'title' => 'БФП',
                    ],
                    [
                        'title' => 'Принтер',
                    ],
                    [
                        'title' => 'Сканер',
                    ],
                    [
                        'title' => 'Фотокамера',
                    ],
                    [
                        'title' => 'Відеокамера',
                    ],
                    [
                        'title' => 'Маршрутизатор',
                    ],
                    [
                        'title' => 'Свіч',
                    ],
                    [
                        'title' => 'Клавіатура',
                    ],
                    [
                        'title' => 'Миша',
                    ],
                    [
                        'title' => 'Проекційний екран',
                    ],
                    [
                        'title' => 'ББЖ (UPS)',
                    ],
                    [
                        'title' => 'Подовжувач',
                    ],
                    [
                        'title' => 'Кріплення ТВ, проектора',
                    ],
                    [
                        'title' => 'Телевізор',
                    ],
                    [
                        'title' => 'Колонки',
                    ],
                    [
                        'title' => 'Підслювач акустичний',
                    ],
                    [
                        'title' => 'Мікрофон',
                    ],
                    [
                        'title' => 'Навушники',
                    ],
                    [
                        'title' => 'Акустична радіосистема',
                    ],
                    [
                        'title' => 'Жорсткий диск HDD',
                    ],
                    [
                        'title' => 'Твердотільний диск SSD',
                    ],
                    [
                        'title' => 'Материнська плата MB',
                    ],
                    [
                        'title' => 'Процесор CPU',
                    ],
                    [
                        'title' => 'ОЗУ RAM',
                    ],
                    [
                        'title' => 'Блок живлення',
                    ],
                    [
                        'title' => 'Штатив',
                    ],
                    [
                        'title' => 'Програмне забезпечення',
                    ],
                    [
                        'title' => 'Шафа серверна',
                    ],
                    [
                        'title' => 'Стійка серверна',
                    ],
                    [
                        'title' => 'Модуль оптичний',
                    ],
                    [
                        'title' => 'Оптобокс',
                    ],
                    [
                        'title' => 'АТС',
                    ],
                    [
                        'title' => 'Шлюз GSM',
                    ],
                    [
                        'title' => 'Камера відеоспостереження',
                    ],
                    [
                        'title' => 'Відеореєстратор',
                    ],
                    [
                        'title' => 'Сигналізація',
                    ],
                    [
                        'title' => 'Датчик руху',
                    ],
                    [
                        'title' => 'Датчик відкриття дверей',
                    ],
                    [
                        'title' => 'Пульт керування сигналізацією',
                    ],
                    [
                        'title' => 'Сирена',
                    ],
                    [
                        'title' => 'Телефон',
                    ],
                    [
                        'title' => 'Інструмент',
                    ],
                    [
                        'title' => 'Картридж',
                    ],
                    [
                        'title' => 'Кабель',
                    ],
                    [
                        'title' => 'Презентер',
                    ]
                ];
        DB::table('inventory_types')->insert($data);
    }
}
