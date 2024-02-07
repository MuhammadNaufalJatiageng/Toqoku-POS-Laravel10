@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/product.css') }}">
@endsection

@section('body')

<div class="container-fluid mt-3">

  <div class="content-wrapper d-flex justify-content-between mb-5">
    
    <section class="product-info me-1 rounded rounded-3 pb-2">

      <div class="d-flex justify-content-between mx-1">
        <h4>Transaksi : {{ $search }}</h4>
        <form action="/transaction" method="post">
          @csrf
          <input type="hidden" name="all">
          <button class="all-transaction fw-bold text-bottom">Lihat semua transaksi</button>
        </form>
      </div>

      @if ($receipts->count() > 0)
        <table class="table mb-3 rounded rounded-3 overflow-hidden">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">No. Transaksi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Waktu</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($receipts as $receipt)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $receipt->transaction_number }}</td>
              <td>{{ $receipt->created_at->isoFormat('dddd, D-M-Y') }}</td>
              <td>{{ $receipt->created_at->format('H:i:s') }}</td>
              <td class="p-1">
                <a href="/transaction/receipt/{{ $receipt->transaction_number }}" class="btn btn-primary py-0 fs-6">Detail</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h6 class="text-center mt-5">Tidak ada transaksi.</h6>
      @endif
        <div class="mx-2">
          {{ $receipts->links() }}
        </div>
    </section>

    <section class="support-content ms-2">
      {{-- Filtering Form --}}
      <div class="filtering px-2 py-3 mb-5 rounded">
        <h5>Pencarian berdasarkan :</h5>
        <form action="/transaction" method="post" role="search" class="d-flex flex-column">
          @csrf
          <input class="form-control" id="noTransaction" type="search" name="noTransaction" placeholder="Nomor transaksi" aria-label="Search">
          <p class="my-1 text-center">atau</p>
          <input type="date" name="date" id="date" class="p-1 rounded border-1">
          <button class="btn btn-warning mt-2 fw-bold">Cari</button>
        </form>
      </div>

    </section>

  </div>
    
</div>

@endsection