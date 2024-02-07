<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function store(Request $request)
    {
        $cart = $request->all();
        
        // CART IS NOT EMPTY cHECK
        if ($request->has('product_id')) 
        {
            for($index = 0; $index < count($cart['product_id']); $index++)
            {
                $productStock = Product::find($cart['product_id'][$index]);
                // PRODUCT STOCK CHECK 
                if($cart['qty'][$index] > $productStock->stock)
                {
                    return redirect('/')->with('fail', "Stok produk tidak mencukupi.");
                }           
            }

            
            // CREATING THE RECEIPT
            if ($request->discountValue == null) {
                $discount = 0;
            } else {
                $discount = intval($request->discountValue);
            }
            
            $data_receipt = [
                'user_id' => auth()->user()->id,
                'transaction_number' => time(),
                'customer' => $request->customer,
                'discount' => $discount
            ];
            
            Receipt::create($data_receipt);
            // GET THE RECEIPT
            $receipt_id = Receipt::latest()->first();
    
            for($i = 0; $i < count($cart['product_id']); $i++)
            {
                $product = Product::find($cart['product_id'][$i]);
                
                $data = [
                    'product_name' => $product->product_name,   
                    'sku' => $product->sku,
                    'product_price' => $product->price,   
                    'base_price' => $product->base_price,   
                    'quantity' => $cart['qty'][$i],   
                    'user_id' => auth()->user()->id,   
                    'subtotal' => $cart['subtotal'][$i],
                    'receipt_id' => $receipt_id->transaction_number,
                ];  
    
                // DECREASE THE PRODUCT STOCK
                $product->stock -= intval($data['quantity']);
                $product->total_purchases += intval($data['quantity']);
                $product->update();
                // CREATE THE RECEIPT DETAIL
                PurchaseDetail::create($data);
            }
    
            Cart::truncate();
            return redirect('/')->with('success', "Transaksi berhasil.");
            
        } else {
            return redirect('/')->with('fail', "Pastikan sudah memilih produk.");
        }
    }
}
