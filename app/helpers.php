<?php

if(!function_exists('getTotal')) {
    function getTotal($var, $params) {
        $total = 0;
        for ($i=0; $i < $var->count(); $i++) { 
            $total += $var[$i]->details->sum($params);
        }
        return $total;
    }
}

if (!function_exists('getProfit')) {

    function getProfit($receipts, $total_income, $total_discount) {
        $base_price = 0;
    
        for ($i=0; $i < $receipts->count() ; $i++) { 
            $receipt = $receipts[$i]->details;
    
            for ($index=0; $index < $receipt->count(); $index++) { 
                $base_price += ($receipt[$index]->base_price * $receipt[$index]->quantity); 
            }
        }
        
        $profit = $total_income - $base_price - $total_discount;
    
        return $profit;
    }
}

if(!function_exists('formatRp')){
    function formatRp($number){
        $newNumber = number_format($number, 0, ',', '.');
        return $newNumber;
    }
}