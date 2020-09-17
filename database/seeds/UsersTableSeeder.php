<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
                'name' => 'Ігор Ростиславович Зубенко',
                'email' => 'admin@oa.edu.ua',
                'role' => 'admin',
                'avatar' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
                'avatar_original' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
                'google_id' => '116474708955860264235',
            ],
            [
                'name' => 'Тест',
                'email' => 'fund@oa.edu.ua',
                'role' => 'user',
                'avatar' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
                'avatar_original' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
                'google_id' => '116474708955860264231',
            ],
        ];
        DB::table('users')->insert($data);

        factory(App\Models\User::class, 2000)->create();
    }
}
