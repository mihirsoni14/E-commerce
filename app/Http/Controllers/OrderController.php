<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin-panel.order.list');
    }
    public function store(Request $request)
    {
        $cart_id = [];
        $cart_item = Cart::where('user_id', Auth::id())->get();
        $address = Address::where('user_id', Auth::id())->get();

        $validation = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_name' => 'string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|digits:6',
            'mobile' => 'required|integer|digits:10|unique:address_entity,mobile',
            'email' => 'required|email|unique:address_entity,email',
        ]);
        $validation['user_id'] = Auth::id();
        Address::create($validation);
        foreach ($cart_item as $cart) {
            $cart_id[] = $cart->id;
        }

        Order::created([
            'user_id' => Auth::id(),
            'cart_id' => $cart_id,

        ]);

        return $cart_id;
        // return "Test";

    }
}
