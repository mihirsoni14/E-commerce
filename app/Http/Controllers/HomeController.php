<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::with('subcategory')->get();
        $categorys = Category::all();

        if ($request->ajax() && $request->action = "search") {

            $categorys = Category::all();
            $products = Product::with('subcategory')->where('category_id', $request->data)->get();
            return view('ajax-searchedData', compact('categorys', 'products'));

        }

        return view('index', compact('products', 'categorys'));
    }



    public function shop(Request $request)
    {

        $data['products'] = Product::with('subcategory')->paginate(9);
        $data['categorys'] = Category::all();

        if ($request->ajax()) {
            $id = $request->id;
            $data['products'] = Product::where('category_id', $id)->with('subcategory')->paginate(9);
            $data['categorys'] = Category::all();
            return view('shop_product')->with($data);

        }



        return view('shop')->with($data);
    }

}
