<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('ru_RU');
        $type = 'taxi';
        if(rand(0,5) == 5){
            $type = 'deliv';   
        }
        
        return [
            'type' => $type,
            'startPoint' => $this->faker->streetAddress(),
            'finishPoint' => $this->faker->streetAddress(),
            'distance' => $this->faker->randomDigitNotNull(),
            'time' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}