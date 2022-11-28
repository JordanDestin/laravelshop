<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Address;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::factory(4)->create();
      //  Address::factory(2)->create();

// $user = User::factory()
// ->count(10)
// ->has(
//     Address::factory()
// ->count(2)
// )
// ->create();




//                Order::factory()
//                     ->count(3)
//                     ->for($user)
//                     ->hasAttached(
//                         Product::factory()->count(5),
//                         ['total_price' => rand(100, 500), 'total_quantity' => rand(1,3)]
//                     )
//                     ->create();


        // User::factory()
        //     ->count(10)
        //     ->has(
        //         Address::factory()
        //             ->count(2)
        //     )
        //     ->has(
        //         Order::factory()
        //             ->count(3)
        //             ->hasAttached(
        //                 Product::factory()->count(5),
        //                 ['total_price' => rand(100, 500), 'total_quantity' => rand(1,3)]
        //             )
        //     )
            
        //     ->create();

        Product::factory()->count(50)->create();

        // Create User admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'admin' => true
        ]);
    }
}