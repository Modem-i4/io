<?php

namespace Database\Factories;

use App\Models\InventoryRepair;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryRepairFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryRepair::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => now(),
            'end_date' => now()->addDays(11),
            'user_id' => $this->faker->numberBetween(1, 3),
            'provider_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
