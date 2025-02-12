<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Process;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin-panel.product.list', compact('products'));
    }


    public function create()
    {
        $subCategory = SubCategory::all();
        $category = Category::all();
        return view('admin-panel.product.create', compact('subCategory', 'category'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('images'), $imageName);
            $imageName = 'images/' . $imageName;
        }

        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image' => 'nullable'
        ]);

        if (array_key_exists('image', $validate)) {
            $validate['images'] = $imageName;
            unset($validate['image']);
        }



        Product::create($validate);
        return redirect()->route('dashbord');


    }
}
