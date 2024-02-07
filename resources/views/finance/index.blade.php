@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/finance.css') }}">
@endsection

@section('body')
<section class="container mb-5">
{{-- Information --}}
    <div class="rounded rounded-5 shadow bg-light mt-3 p-5 information-wrapper">
        <h3>Laporan : {{ $title }}</h3>
        <div class="row mt-3 justify-content-between">
            <div class="finance-info text-end rounded rounded-3 p-3">
                <h4 class="fw-bold">Total pendapatan</h4>
                <h5 class="me-2">{{ formatRp($income) }}</h5>
            </div>
            <div class="finance-info text-end rounded rounded-3 p-3">
                <h4 class="fw-bold">Total Diskon</h4>
                <h5 class="me-2">{{ formatRp($total_discount) }}</h5>
            </div>
            <div class="finance-info text-end rounded rounded-3 p-3">
                <h4 class="fw-bold">Total Profit</h4>
                <h5 class="me-2 {{ $profit < 0 ? 'text-danger' : '' }}">
                    {{ formatRp($profit) }}
                </h5>
            </div>
            <div class="finance-info text-end rounded rounded-3 p-3">
                <h4 class="fw-bold">Produk Terjual</h4>
                <h5 class="me-2">{{ formatRp($product_sold) }}</h5>
            </div>
        </div>
    </div>
{{-- Search Filter --}}
    <div class="row mt-4 rounded rounded-4 shadow bg-light p-4 mx-1 search-wrapper justify-content-between align-items-end">
        <h3>Cari Berdasarkan :</h3>
        <div class="col-lg-6 d-flex justify-content-between mt-2 shortcut-filter">
            <form action="/transaction" method="post">
                @csrf
                <input type="hidden" name="this_week">
                <button class="btn btn-red text-light p-2 fw-bold px-4">Minggu Ini</button>
            </form>
            <form action="/transaction" method="post">
                @csrf
                <input type="hidden" name="this_month">
                <button class="btn btn-success p-2 fw-bold px-4">Bulan Ini</button>
            </form>
            <form action="/transaction" method="post">
                @csrf
                <input type="hidden" name="this_year">
                <button class="btn btn-warning p-2 fw-bold px-4 text-light">Tahun Ini</button>
            </form>
        </div>
        
        <div class="col-lg-6">
            <form action="/transaction" method="post" class="d-flex">
                @csrf
                <input type="text" class="form-control me-4 border-2" placeholder="Nomor transaksi" id="noTransaction" name="noTransaction">
                <button class="btn btn-primary fw-bold px-5">Cari</button>
            </form>
        </div>
    </div>

    <div class="row mt-4 rounded rounded-4 shadow bg-light p-4 mx-1">
        <form action="/transaction" class="filter" method="post">
            @csrf
            <div class="search-from">
                <label for="from" class="d-block mb-2">Dari Tanggal :</label>
                <input type="date" name="from" id="from" class="w-100 form-control border-2">
            </div>
            <i class="bi bi-dash-lg mb-2"></i>
            <div class="search-to">
                <label for="to" class="d-block mb-2">Sampai Tanggal :</label>
                <input type="date" name="to" id="to" class="w-100 form-control border-2">
            </div>
            <div>
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
{{-- Transaction and product details --}}
    <div class="d-flex justify-content-between my-4 t-p-detail">
        
        <div class="transaction-details p-4 shadow rounded rounded-5">
            <div class="d-flex justify-content-between">
                <h4>Daftar Transaksi : </h4>
                <p>{{ formatRp($receipts->count()) }} transaksi ditemukan.</p>
            </div>
            <div class="table-wrapper rounded rounded-2">
                @if ($receipts->count() > 0)
                    <table>
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">No. Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Produk Terjual</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $receipt)
                                <tr class="text-center">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $receipt->transaction_number }}</td>
                                    <td>{{ $receipt->created_at->isoFormat('D-M-Y') }}</td>
                                    <td>{{ $receipt->created_at->format('H:i:s') }}</td>
                                    <td>
                                        {{ $receipt->details->sum('quantity') }}
                                    </td>
                                    <td>{{ formatRp($receipt->discount) }}</td>
                                    <td>{{ $receipt->customer === null ? '-' :  $receipt->customer}}</td>
                                    <td class="p-1">
                                        <a href="/transaction/receipt/{{ $receipt->transaction_number }}" class="btn btn-primary py-0 fs-6">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="text-center mt-3">
                    <p class="mb-0">Belum ada transaksi.</p>
                    <p>Lakukan <a href="{{ route('dashboard') }}" class="text-decoration-none">Disini.</a></p>
                </div>  
                @endif
            </div>
        </div>

        <div class="product-wrapper">
            <div class="product-info p-4 shadow rounded rounded-5">
                <h4>Produk Terlaris</h4>
                <div class="table-wrapper rounded rounded-2">
                    @if ($products->count() > 0)
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Produk Terjual</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="text-center">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->total_purchases }} pcs</td>
                                        <td class="p-1">
                                            <a href="/product/detail/{{ $product->id }} }}" class="btn btn-primary py-0 fs-6">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center mt-3">
                            <p class="mb-0">Belum ada produk.</p>
                            <p>Tambah <a href="/product" class="text-decoration-none">Disini.</a></p>
                        </div>  
                    @endif
                </div>
            </div>
        </div>

    </div>

</section>
@endsection