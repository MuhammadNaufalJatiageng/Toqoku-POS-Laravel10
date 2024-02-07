<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller
{
    public function update(Request $request, Store $store, $id)
    {
        $request->validate([
            'store_name' => 'max:25'
        ]);

        $data = $store->find($id);

        $data['store_name'] = $request->store_name;
        $data['phone_number'] = $request->phone_number;
        $data['address'] = $request->address;

        $data->save();
        
        return Redirect::route('profile.edit')->with('status', 'store-updated');
    }
}
