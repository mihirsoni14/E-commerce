<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Log;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SubCategory::truncate();
        $sub_catagory = [
            'Fruits' => ['Fresh Fruits', 'Citrus Fruits', 'Berries Fruits', 'Tropical Fruits', 'Dried Fruits'],
            'Vegetables' => ['Leafy Vegetables', 'Root Vegetables', 'Mushrooms', 'Peppers & Chilies', 'Cruciferous Vegetables'],
            'Bakery' => ['Breads', 'Cookies', 'Biscuits'],
            'Dairy' => ['Milk', 'Cheese', 'Butter', 'Yogurt', 'Desserts'],
        ];

        foreach ($sub_catagory as $key => $value) {
            foreach ($value as $val) {
                $category = Category::where('name', $key)->first();
                if ($category) {
                    $existingSubCategory = SubCategory::where('name', $val)->where('category_id', $category->id)->first();
                    if (!$existingSubCategory) {
                        SubCategory::create([
                            'name' => $val,
                            'category_id' => $category->id
                        ]);
                    }
                }
            }
        }

    }
}
