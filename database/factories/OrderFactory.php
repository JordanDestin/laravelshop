<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

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

        $adressIDs = Address::pluck('id');
        return [
            'order_number' => uniqid(),
            'total_order'=> rand(1000, 15000),
            'address_id'=> $adressIDs
        ];
    }
}
