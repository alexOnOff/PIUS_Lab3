<?php

namespace Database\Factories\Domain\Clients\Models;

use App\Domain\Clients\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('ru_RU');
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->word(),
        ];
    }
}
