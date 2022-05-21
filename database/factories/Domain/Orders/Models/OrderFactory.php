<?php

namespace Database\Factories\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Domain\Orders\Models\Order;
use App\Domain\Autos\Models\Auto;
use App\Domain\Clients\Models\Client;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
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
          //  'client_id' => Client::factory(), //
          //  'auto_id' => Auto::factory(), //
        ];
    }
}