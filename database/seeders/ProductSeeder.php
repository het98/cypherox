<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Chair',
            'description' => 'Good one and make feel comfortable',
            'image' => 'ProductImage/lap.jpg',
            'categories_id' => '1',
            'price' => '1000',
        ]);

       
    }
}
