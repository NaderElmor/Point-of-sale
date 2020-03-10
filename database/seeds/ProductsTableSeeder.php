<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => '1',
            'purchase_price' => 100,
            'sale_price' => 125,
            'stock' => 5000,

            'en' => ['name' => 'bagProduct', 'description' => 'this is desc'],
            'ar' => ['name' => 'منتج حقيبة', 'description' => 'هذا وصف']

        ]);    

        Product::create([
            'category_id' => '2',
            'purchase_price' => 100,
            'sale_price' => 125,
            'stock' => 5000,

            'en' => ['name' => 'shoesProduct', 'description' => 'this is desc'],
            'ar' => ['name' => 'منتج حذاء', 'description' => 'هذا وصف']

        ]);    
    }
}
