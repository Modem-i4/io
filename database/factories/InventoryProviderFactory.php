<?php

namespace Database\Factories;

use App\Models\InventoryProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->e164PhoneNumber
        ];
    }
}
