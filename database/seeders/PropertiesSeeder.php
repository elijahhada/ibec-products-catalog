<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            5,
            10,
            15,
            30,
            50,
            75,
        ];

        foreach ($discounts as $discount) {
            Property::create(['title' => 'discount', 'value' => $discount]);
        }
        Property::create(['title' => 'is_available', 'value' => true]);
        Property::create(['title' => 'is_available', 'value' => false]);
    }
}
