<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)
                ->where('product_id', $request->product_id)
                ->count();

        if($cart > 0)
        {
            return back()->with('warning', 'Produk sudah ada di keranjang.');
        }
        else
        {
            $newCart = new Cart;
            $newCart->user_id = auth()->user()->id;
            $newCart->product_id = $request->product_id;
            $newCart->quantity = 1;
            $newCart->save();
            return back();
        }
    }

    public function update(Request $request, Cart $cart, $id)
    {
        $product = $cart->find($id);
        
        if($request->has('qty-plus'))
        {
            $product->quantity += 1;
            $product->save();
        }
        if($request->has('qty-min'))
        {
            if($product->quantity > 1) {
                $product->quantity -= 1;
                $product->save();
            }else {
                $product->delete();
            }
        }
        if ($request->has('onchange'))
        {
            $product->quantity = $request->onchange;
            $product->save();
        }
        return back();
    }

    public function destroy(Cart $cart, $id)
    {
        {
            $item = Cart::find($id);
            $item->delete();
    
            return redirect('/');
        }
    }
}
