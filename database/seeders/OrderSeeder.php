<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Domain\Clients\Models\Client;
use App\Domain\Orders\Models\Order;
use App\Domain\Autos\Models\Auto;

use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create('ru_RU');
        Order::factory()
                ->count(10)
                ->has(Client::factory()->count($this->faker->randomDigitNotNull), 'clients')
                ->has(Auto::factory()->count($this->faker->randomDigitNotNull), 'autos')
                ->create();
    }
}