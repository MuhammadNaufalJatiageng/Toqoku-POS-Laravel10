<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
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

        User::create([
            'name' => "Muhammad Naufal",
            'email' => 'mnja@gmail.com',
            'password' => bcrypt('password')
        ]);

        Store::create([
            'store_name' => "Toko Anak Negeri",
            'address' => 'Perumahan Medang Lestari, Pagedangan, Kabupaten Tangerang',
            'phone_number' => "081284920064",
            'user_id' => 1
        ]);

        Product::create([
            'product_name' => "Sampurna Mild 16",
            'stock' => 10,
            'price' => 32000,
            'base_price' => 30500,
            'user_id' => 1,
            'sku' => 'SM-16',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Dji Sam Soe 12",
            'stock' => 10,
            'price' => 20000,
            'base_price' => 18400,
            'user_id' => 1,
            'sku' => 'DSS-12',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Gulaku 1kg",
            'stock' => 10,
            'price' => 18000,
            'base_price' => 16000,
            'user_id' => 1,
            'sku' => 'GLK-1',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Segitiga Biru 1kg",
            'stock' => 10,
            'price' => 13000,
            'base_price' => 12000,
            'user_id' => 1,
            'sku' => 'TSB-1',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Tolak Angin",
            'stock' => 10,
            'price' => 4000,
            'base_price' => 3200,
            'user_id' => 1,
            'sku' => 'TAC',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Sukro",
            'stock' => 10,
            'price' => 1000,
            'base_price' => 800,
            'user_id' => 1,
            'sku' => 'SKR',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Oreo",
            'stock' => 10,
            'price' => 2000,
            'base_price' => 1800,
            'user_id' => 1,
            'sku' => 'ORO',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Popcorn Karamel",
            'stock' => 10,
            'price' => 2000,
            'base_price' => 1700,
            'user_id' => 1,
            'sku' => 'PCK',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Popcorn Cokelat",
            'stock' => 10,
            'price' => 2000,
            'base_price' => 1700,
            'user_id' => 1,
            'sku' => 'PCC',
            'total_purchases' => 0,
        ]);
        Product::create([
            'product_name' => "Superstar",
            'stock' => 10,
            'price' => 1000,
            'base_price' => 800,
            'user_id' => 1,
            'sku' => 'SPR',
            'total_purchases' => 0,
        ]);
    }
}
