<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusTableSeeder::class
        ]);

        User::factory()
            ->hasOrders(5)
            ->create();

        Order::factory()
            ->count(3)
            ->for(User::factory()
                ->create())
            ->create();

        Product::factory()
            ->hasOrders(2)
            ->create();

        Order::factory()
            ->hasProducts(4)
            ->create();
    }
}
