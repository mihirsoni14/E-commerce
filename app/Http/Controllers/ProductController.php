<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function addtocart(Request $request)
    {
        $id = $request->product_id;
        $filter = Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
        $count = Cart::where('user_id', Auth::user()->id)->count();


        if (!$filter) {
            $data = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
            ]);

            $count = Cart::where('user_id', Auth::user()->id)->count();
            return response()->json(['message' => "Add to cart successfully", 'count' => $count]);
        } else {
            return response()->json(['message' => "Item already exist", 'count' => $count]);
        }
    }
    public function cart()
    {
        $items = Cart::where('user_id', Auth::id())->get();
        return view('cart', compact('items'));
    }
    public function cartUpdate(Request $request)
    {
        Cart::where('id', $request->cart_id)->update([
            'quantity' => $request->qty,
        ]);
        $data = Cart::with('product')->find($request->cart_id);
        return $data;
    }

    public function removeItemFromCart(Request $request)
    {
        $item = Cart::find($request->cart_id);
        $item->delete();
    }
    public function checkout(Request $request)
    {
        $items = Cart::where('user_id', Auth::id())->get();
        return view('checkout', compact('items'));
    }
    public function orderProccess(Request $request)
    {
        return $request->all();
    }





}
