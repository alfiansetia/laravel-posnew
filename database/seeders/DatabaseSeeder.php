<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
        ]);

        $sale = Sale::Create([
            'number' => 1,
            'date' => date('Y-m-d H:i:s'),
            'user_id' => 1,
            'customer_id' => 1,
            'tax' => 0,
            'total' => 50000,
            'bill' => 50000,
            'status' => 'unpaid',
            'desc' => 'Pembelian ke 1',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $i,
                'price' => 10000,
                'qty'   => 1,
                'disc'  => 0,
            ]);
        }

        $sale2 = Sale::Create([
            'number' =>  2,
            'date' => date('Y-m-d H:i:s'),
            'user_id' => 1,
            'customer_id' => 1,
            'tax' => 0,
            'total' => 50000,
            'bill' => 50000,
            'status' => 'paid',
            'desc' => 'Pembelian ke 2',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            SaleDetail::create([
                'sale_id' => $sale2->id,
                'product_id' => $i,
                'price' => 10000,
                'qty'   => 1,
                'disc'  => 0,
            ]);
        }

        $sale3 = Sale::Create([
            'number' => 3,
            'date' => date('Y-m-d H:i:s'),
            'user_id' => 1,
            'customer_id' => 1,
            'tax' => 0,
            'total' => 50000,
            'bill' => 50000,
            'status' => 'cancel',
            'desc' => 'Pembelian ke 3',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            SaleDetail::create([
                'sale_id' => $sale3->id,
                'product_id' => $i,
                'price' => 10000,
                'qty'   => 1,
                'disc'  => 0,
            ]);
        }
    }
}
