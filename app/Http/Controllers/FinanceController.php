<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        $receipts = Receipt::where('user_id', auth()->user()->id)
                            ->whereDate('created_at', Carbon::today())
                            ->get();

        // Get Total Income
        $total_income = getTotal($receipts, 'subtotal');
        // Get  Product Sold
        $product_sold = getTotal($receipts, 'quantity');
        // Get Total Discount
        $total_discount = $receipts->sum('discount');

        // Get The Profit
        $profit = getProfit($receipts, $total_income, $total_discount);

        return view('finance.index', [
            'title' => "Hari ini",
            'products' => Product::where('user_id', auth()->user()->id)->orderBy('total_purchases', 'desc')->get(),
            'receipts' => $receipts,
            'income' => $total_income,
            'profit'=> $profit,
            'product_sold' => $product_sold,
            'total_discount' => $total_discount
        ]);
    }

    public function filter(Request $request)
    {
        $today = Carbon::today();
        
        if ($request->has('this_week')) {

            $receipts = Receipt::where('user_id', auth()->user()->id)
                                ->whereDate('created_at', '>=', $today->startOfWeek())
                                ->whereDate('created_at', '<=', $today->endOfWeek())
                                ->latest()->get();

            $title = 'Minggu Ini';
        }

        if ($request->has('this_month')) {
            
            $receipts = Receipt::where('user_id', auth()->user()->id)
                                ->whereDate('created_at', '>=', $today->startOfMonth())
                                ->whereDate('created_at', '<=', $today->endOfMonth())
                                ->latest()->get();

            $title = 'Bulan Ini';
        }

        if ($request->has('this_year')) {
            $receipts = Receipt::where('user_id', auth()->user()->id)
                                ->whereDate('created_at', '>=', $today->startOfYear())
                                ->whereDate('created_at', '<=', $today->endOfYear())
                                ->latest()->get();

            $title = 'Tahun Ini';
        }

        if ($request->has('noTransaction')) 
        {
            $receipts = Receipt::where('user_id', auth()->user()->id)
                                ->where('transaction_number', $request->noTransaction)
                                ->get();

            $title = $request->noTransaction;
        }

        if ($request->has('from')) 
        {
            if ($request->from && $request->to) 
            {
                $start_date = $request->from;
                $end_date = $request->to;

                $receipts = Receipt::where('user_id', auth()->user()->id)
                                        ->whereDate('created_at', '>=', $start_date)
                                        ->whereDate('created_at', '<=', $end_date)
                                        ->get();

                $title = str_replace('-', '/', $start_date). " - ".str_replace('-', '/', $end_date);
            } 
            else 
            {
                return redirect('/transaction');
            }
        }

        // Get Total Income
        $total_income = getTotal($receipts, 'subtotal');
        // Get  Product Sold
        $product_sold = getTotal($receipts, 'quantity');
        //  Get Total Discount
        $total_discount = $receipts->sum('discount');

        // Get The Profit
        $profit = getProfit($receipts, $total_income, $total_discount);

        return view('finance.index', [
            'title' => $title,
            'products' => Product::where('user_id', auth()->user()->id)->orderBy('total_purchases', 'desc')->get(),
            'receipts' => $receipts,
            'income' => $total_income,
            'profit'=> $profit,
            'product_sold' => $product_sold,
            'total_discount' => $total_discount
        ]);
    }
}
