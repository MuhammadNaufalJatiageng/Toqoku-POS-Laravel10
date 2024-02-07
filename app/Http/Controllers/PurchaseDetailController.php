<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Receipt;
use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;

class PurchaseDetailController extends Controller
{
    public function show(PurchaseDetail $purchaseDetail, $noTransaction)
    {
        $details = $purchaseDetail->where('receipt_id', $noTransaction)->get();
        $receipt = Receipt::where('transaction_number', $noTransaction)->get();

        // Get the profit
        $selling_price = 0;
        $base_price = 0;
        
        for ($i=0; $i < $details->count() ; $i++) { 
            $selling_price += $details[$i]->product_price * $details[$i]->quantity;
            $base_price += $details[$i]->base_price * $details[$i]->quantity;
        }

        $profitBeforeDisc = ($selling_price - $base_price);
        $profitAfterDisc = ($selling_price - $base_price) - $receipt[0]->discount;
        
        return view('history.receipt.detail', [
            'store' => Store::where('user_id', auth()->user()->id)->first(),
            'details' => $details,
            'receipt' => $receipt[0],
            'profitBeforeDisc' => $profitBeforeDisc,
            'profitAfterDisc' => $profitAfterDisc
        ]);
    }
}
