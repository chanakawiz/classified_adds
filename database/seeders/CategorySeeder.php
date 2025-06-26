<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Vehicles',
            'Electronics',
            'Real Estate',
            'Jobs',
            'Services',
            'Fashion',
            'Home & Garden',
            'Pets',
            'Books',
            'Sports & Outdoors',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
