<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Puzzle Games','order'=>'1'],
            ['name' => 'Arcade Games','order'=>'2'],
            ['name' => 'Action Games','order'=>'3'],
            ['name' => 'Card Games','order'=>'4'],
            ['name' => 'Slots','order'=>'5'],
            ['name' => 'Others','order'=>'6'],
        ];
        foreach ($categories as $category) {
            $name = $category['name'];
            $slug = Str::slug($name);
            Category::create([
                'name'  =>  $category['name'],
                'slug'  =>  $slug,
                'order' =>  $category['order']
            ]);
        }
    }
}
