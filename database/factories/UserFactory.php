<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'google_id' => '116474708955860264235',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'avatar' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
        'avatar_original' => 'https://lh5.googleusercontent.com/-d_60A16k1Qo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclJXsCCfufd8iQ89JnaZofl6R7jGw/photo.jpg',
    ];
});
