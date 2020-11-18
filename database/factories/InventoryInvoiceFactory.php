<?php

namespace Database\Factories;

use App\Models\InventoryInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryInvoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(10000, 99999),
            'date' => now(),
            'provider_id' => $this->faker->numberBetween(1, 100),
            'file_url' => 'some/file/url/for/test.txt',
            'total_sum' => $this->faker->numberBetween(12000, 114280),
        ];
    }
}
