<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'products' => Product::where('user_id', auth()->user()->id)->orderBy('product_name', 'asc')->paginate(10),
            'new_products' => Product::where('user_id', auth()->user()->id)->latest()->take(5)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:30',
            'modal' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'integer',
            'pict' => 'image|mimes:jpeg,jpg,png',
            'sku' => 'required|max:6'
        ]);

        $validated['product_name'] = $request->name;
        $validated['base_price'] = $request->modal;
        $validated['price'] = $request->price;
        $validated['stock'] = $request->stock;
        $validated['total_purchases'] = 0;
        $validated['sku'] = strtoupper($request->sku);
        $validated['profit'] = ($request->price) -  ($request->modal);
        $validated['user_id'] = auth()->user()->id;

        
        if ($request->hasFile('pict')) 
        {
            $validated['picture'] = $request->file('pict')->store('product-img', 'public');
        }

        Product::create($validated);
        return redirect('/product')->with('success', 'Berhasil menambahkan produk.');
    }

    public function show(Product $product, $id)
    {
        return view('product.detail',[
            'product' => $product->find($id)
        ]);
    }

    public function update(Request $request, Product $product , $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:30',
            'modal' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'integer',
            'pict' => 'image|mimes:jpeg,jpg,png',
            'sku' => 'max:10'
        ]);

        $validated['product_name'] = $request->name;
        $validated['base_price'] = $request->modal;
        $validated['price'] = $request->price;
        $validated['stock'] = $request->stock;
        $validated['sku'] = $request->sku;
        $validated['user_id'] = auth()->user()->id;

        
        if ($request->hasFile('pict')) 
        {
            if($request->oldPict)
            {
                Storage::delete('/public/'.$request->oldPict);
            }
            $validated['picture'] = $request->file('pict')->store('product-img', 'public');
        }

        $product->find($id)->update($validated);

        return back()->with('success', 'Berhasil memperbarui data.');
    }

    public function destroy(Product $product, $id)
    {
        $data = $product->find($id);
        $dataName = $data->product_name;

        if($data->picture){
            Storage::delete('/public/'.$data->picture);
        }
        
        Cart::where('product_id', $id)->delete();

        $data->delete();

        return redirect('/product')->with('success', "Berhasil menghapus " . $dataName . " . ");
    }
}
