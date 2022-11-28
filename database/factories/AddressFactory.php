<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIDs = User::pluck('id');
        return [
            'address' => $this->faker->sentence(rand(1,3),true),
            'addressbis'=> $this->faker->sentence(),
            'postal'=>rand(10000,50000),
            'city'=> $this->faker->sentence(rand(1,3),true),
           // 'user_id'=> $userIDs->random(),
        ];
    }
}
