<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Seeder;

class SyncSomeProductsWithProperties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = Property::where('title', 'discount')->get()->pluck('id')->toArray();
        $availabilities = Property::where('title', 'is_available')->get()->pluck('id')->toArray();
        $products = Product::all()->take(1000);

        foreach ($products as $product) {
            if (rand(1, 100) % 3 === 0) {
                $product->properties()->attach($discounts[array_rand($discounts)]);
            }
            $product->properties()->attach($availabilities[array_rand($availabilities)]);
        }
    }
}
