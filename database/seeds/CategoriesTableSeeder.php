<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
            Category::create(
                [
                    'en' => ['name' => 'Bags'],
                    'ar' => ['name' => 'حقائب']
                ]
            );
        
            Category::create(
                [
                    'en' => ['name' => 'Shoes'],
                    'ar' => ['name' => 'أحذية']
                ]
            );
  
    }
}
