<?php

namespace Database\Seeders;

use App\Models\Adjustment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdjustmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();
        for ($i = 0; $i < 20; $i++) {
            Adjustment::factory()->create([
                'product_id'    => $products->random()->id,
                'user_id'       => $users->random()->id,
            ]);
        }
    }
}
