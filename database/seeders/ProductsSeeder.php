<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            1000,
            1200,
            1500,
            1700,
            2000,
            5000,
            10000,
            25000,
            100000,
        ];
        $categories = Category::where('level', '!=', 1)->select('id')->get()->pluck('id')->toArray();
        $insertData = [];

        for ($i = 0; $i < 10000; $i++) {
            $title = fake()->text(25);
            $insertData[] = [
                'title'       => $title,
                'description' => fake()->text(350),
                'slug'        => Str::slug($title),
                'price'       => $prices[array_rand($prices)],
                'category_id' => $categories[array_rand($categories)],
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        foreach (array_chunk($insertData, 1000) as $item) {
            Product::insert($item);
        }
    }
}
