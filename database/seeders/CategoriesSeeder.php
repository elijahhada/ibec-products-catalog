<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            if (Category::all()->count() < 10) {
                Category::create([
                    'title'     => fake()->text(25),
                    'level'     => 1,
                    'parent_id' => null,
                ]);
                continue;
            }
            $category = Category::where('level', '!=', 3)->select('id', 'level')->get()->random();
            Category::create([
                'title'     => fake()->text(25),
                'level'     => $category['level'] + 1 ?? 1,
                'parent_id' => $category['id'] ?? null,
            ]);
        }
    }
}
