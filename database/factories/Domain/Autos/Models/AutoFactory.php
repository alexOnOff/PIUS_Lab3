<?php

namespace Database\Factories\Domain\Autos\Models;

use App\Domain\Autos\Models\Auto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class AutoFactory extends Factory
{
    protected $model = Auto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('ru_RU');
      
        return [
            'mark' => $this->faker->word(),
            'cost' => $this->faker->randomDigitNotNull(),
        ];
    }
}