@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/receipt.css') }}">
@endsection

@section('body')
    <div class="container mt-3">
        <div class="content-wrapper wrapper p-3 rounded rounded-3">
            <div class="row justify-content-center gap-5">

                <div class="col-lg-3 receipt-wrapper" >
                    <div id="receipt"> 
                        <section class="receipt-header text-center pt-3">
                            <h5>{{ $store->store_name }}</h5>
                            <h5>Struk Belanja</h5>
                            <p class="mb-1">{{ $details[0]->receipts_id }}</p>
                            <small>{{ $store->address }}</small>
                            <small>
                                {{ $details[0]->created_at->isoFormat('D/M/Y') }}
                                {{ $details[0]->created_at->format('H:i:s') }}
                            </small>
                            <small>{{ $store->phone_number }}</small>
                        </section>

                        <table class="mt-4 details w-100">
                            @foreach ($details as $detail)
                                <tr>
                                    <td><b>{{ $detail->sku }}</b></td>
                                    <td>{{ $detail->product_name }}</td>
                                    <td class="text-end">{{ formatRp($detail->product_price) }} @ {{ formatRp($detail->quantity) }}</td>
                                    <td class="text-end total">{{ formatRp($detail->subtotal) }}</td>
                                </tr>
                            @endforeach
                        </table>
                            
                        <section class="d-flex justify-content-end mt-3 me-3">
                            <table>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>:</td>
                                    <td class="text-end subtotal"></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td class="text-end discount">{{ formatRp($receipt->discount) }}</td>
                                </tr>
                                <tr>
                                    <td>Total </td>
                                    <td>: </td>
                                    <td class="text-end total-payment"></td>
                                </tr>
                            </table>
                        </section>
                    </div>
                </div>

                <div class="col-lg-5 bg-light p-3 rounded">
                    <h4>Informasi pembelian</h4>

                    <div class="row justify-content-center my-3">
                        <div class="col-sm-5 bg-receipt-info shadow p-2 rounded rounded-3 mx-2 mb-3">
                            <h5>Pendapatan Kotor</h5>
                            <h3 class="subtotal"></h3>
                        </div>
                        <div class="col-sm-5 bg-receipt-info shadow p-2 rounded rounded-3 mx-2 mb-3">
                            <h5>Diskon</h5>
                            <h3>{{ formatRp($receipt->discount) }}</h3>
                        </div>
                        <div class="col-sm-5 bg-receipt-info shadow p-2 rounded rounded-3 mx-2 mb-3">
                            <h6>Profit sebelum diskon</h6>
                            <h3>{{ formatRp($profitBeforeDisc) }}</h3>
                        </div>
                        <div class="col-sm-5 bg-receipt-info shadow p-2 rounded rounded-3 mx-2 mb-3">
                            <h6>Profit setelah diskon</h6>
                            <h3 class="{{ $profitAfterDisc < 0 ? 'text-danger' : 'text-success' }}" >
                                {{ formatRp($profitAfterDisc) }}
                            </h3>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('/js/receipt.js') }}"></script>
@endsection