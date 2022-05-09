<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Domain\Autos\Models\Auto;
use Faker\Factory as Faker;
class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create('ru_RU');
        Auto::factory()->count(10)->create();
    }
}