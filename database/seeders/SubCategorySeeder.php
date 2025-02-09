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
            'Electronics' => ['mobile', 'laptop', 'tablet', 'camera', 'headphone', 'speaker', 'watch', 'accessories'],
            'Fashion' => ['men', 'women', 'kids', 'footwear', 'accessories', 'jewelry', 'bags', 'watches'],
            'Automotive' => ['car', 'bike', 'accessories', 'tools', 'lubricants', 'tyres', 'helmet', 'riding gear'],
            'Groceries' => ['fruits', 'vegetables', 'dairy', 'beverages', 'snacks', 'household', 'personal care', 'baby care'],
            'Others' => ['books', 'stationary', 'gifts', 'toys', 'sports', 'fitness', 'home', 'kitchen'],
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
