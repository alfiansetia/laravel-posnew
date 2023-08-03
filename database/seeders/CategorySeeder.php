<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Category::create([
                'name' => 'Data Ke ' . $i + 1,
                'desc' => 'Ini ada;ah deskripsi data ke ' . $i + 1,
            ]);
        }
    }
}
