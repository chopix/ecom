<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaddleProduct;

class PaddleProductSeeder extends Seeder
{
    public function run()
    {
        PaddleProduct::create([
            'title' => 'Example Product',
            'description' => 'This is an example product.',
            'price' => '19.99',
            'paddle_product_id' => 'example_id',
            'paddle_price_id' => 'example_price_id',
        ]);
    }
}