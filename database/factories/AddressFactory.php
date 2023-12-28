<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Home Address', 'Office Address', 'Hotel Address', 'Dorm Address']),
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
//        'district_id' => mt_rand(1, 100),
            // 'city_id' => $city_id,
            // 'state_id' => $state_id,
            // 'country_id' => 104,
            'phone' => $this->faker->phoneNumber,
            'map_latitude' => $this->faker->latitude,
            'map_longitude' => $this->faker->longitude,
            'type' => $this->faker->randomElement(['main', 'billing', 'home', 'office']),
        ];
    }
}
