@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/product.css">
@endsection

@section('body')

<div class="container-fluid mt-3">

  <div class="content-wrapper d-flex justify-content-between mb-5">
    
    <section class="product-info me-1 rounded rounded-3">

      <h4 class="fw-bold fs-3 mb-2">Daftar Produk</h4>
      <div class="table-wrapper">
        @if ($products->count() > 0)
          <table class="table mb-3 rounded rounded-3 overflow-hidden">
            <thead>
              <tr>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Modal</th>
                <th scope="col">stok</th> 
                <th scope="col">SKU</th>
                <th scope="col">Opsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                    <td>
                      {{ $product->product_name }}
                      @if ($product->stock <= 5 &&  $product->stock > 0)
                        <i class="bi bi-exclamation-circle-fill text-warning"></i>
                      @endif
                      @if ($product->stock == 0)
                        <i class="bi bi-exclamation-circle-fill text-danger"></i>
                      @endif
                    </td>
                    <td class="text-end">{{ formatRp($product->price) }}</td>
                    <td class="text-end">{{ formatRp($product->base_price) }}</td>
                    <td class="text-end">{{ formatRp($product->stock) }}</td>
                    <td>{{ $product->sku }}</td>
                    <td class="p-1">
                      <!-- Detail Link-->
                      <div>
                        <a href="/product/detail/{{ $product->id }}" class="btn btn-primary py-1 px-2 fs-6">
                          <i class="bi bi-pencil-fill"></i>
                          Update
                        </a>
                      </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <h6 class="text-center mt-5">Belum apa produk, silahkan tambahkan produk.</h6>
        @endif
      </div>
      <div class="mx-2 paginate">
        {{ $products->links() }}
      </div>
    </section>

    <section class="support-content">
      <!-- Button trigger modal create-->
      <div class="mb-3" >
        <a href="/create" class="btn btn-primary insert p-2 fs-5 w-100" data-bs-toggle="modal" data-bs-target="#modalcreate">
          <i class="bi bi-plus-square-fill"></i>
          <p class="d-inline ms-1">Tambah Produk</p>
        </a>
      </div>

      <div class="content p-2 mb-2 rounded rounded-3">
        <h4 class="fw-bold fs-3 mb-2">Produk terbaru</h4>
        <div class="mt-2">

          <table class="table rounded rounded-3 overflow-hidden">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Detail</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($new_products as $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->product_name }}</td>
                  <td><small>{{ $item->created_at->diffForHumans() }}</small></td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>

    </section>

  </div>
    
</div>

@include('product.modal-create')
@endsection

@section('script')
  <script src="/js/modal.js"></script>
  <script src="/js/previewImage.js"></script>
@endsection