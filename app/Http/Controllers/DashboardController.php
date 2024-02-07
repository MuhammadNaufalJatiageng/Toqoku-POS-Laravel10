<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        return view('dashboard.index', [
            'products' => Product::where('user_id', auth()->user()->id)->orderby('product_name')->get(),
            'carts' => Cart::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::where('product_name', 'like', '%'. $request->keyword . '%')
                            ->orWhere('sku', 'like', '%'. $request->keyword . '%')
                            ->orderby('product_name')
                            ->get();

        return view('dashboard.index', [
            'products' => $products->where('user_id', auth()->user()->id),
            'carts' => Cart::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
