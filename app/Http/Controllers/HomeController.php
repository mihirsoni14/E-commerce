<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory')->get();
        $categorys = Category::all();

        return view('index', compact('products', 'categorys'));
    }

    public function getProduct(Request $request)
    {
        return $request->input('name') . $request->query('id');

    }

}
