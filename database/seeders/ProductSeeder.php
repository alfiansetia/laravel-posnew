<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        for ($i = 0; $i < 50; $i++) {
            Product::factory()->create([
                'category_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,
            ]);
        }
    }
}
