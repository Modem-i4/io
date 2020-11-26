<?php

namespace Database\Factories;

use App\Models\InventoryLicense;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryLicenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryLicense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_id' => $this->faker->numberBetween(1, 50),    //TODO: Type for license?
            'title' => $this->faker->company,
            'item_id' => $this->faker->numberBetween(1, 100),
            'invoice_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(120, 890),
            'owner_id' => $this->faker->numberBetween(1, 3),
            //'end_date' => now()->addMonths(17),
        ];
    }
}
