@extends('layouts.main')

@section('body')

<div class="row container-fluid mx-auto mt-3"> 
  <div class="col-lg-7 cart ">
    <div class="load-wrapper"></div>
      <h3 class="fw-bold fs-3 mb-2">Keranjang</h3>
      <div class="cart-list-wrapper border">
        <div class="cart-list">
          <form action="/purchase" method="post">
            @csrf
            <table class="table">
              <tbody>
                @foreach ($carts as $cart)
                    <tr>
                      <td class="product-name">{{ $cart->product->product_name }}</td>
                      <td class="product-price">{{ formatRp($cart->product->price) }}</td>
                      <td class="qty-input">
                          <div>
                              <button class="min"><i class="bi bi-dash-lg"></i></button>
                              <input type="number" class="quantity p-0" value="{{ $cart->quantity }}">
                              <button class="plus"><i class="bi bi-plus"></i></button>
                          </div>
                      </td>
                      <td class="subtotal"></td>
                      <td class="del">
                        <a class="btn btn-danger py-1 px-3 del-btn" data-cartId="{{ $cart->id }}"> 
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>
                    </tr>
                @endforeach
                    {{-- Another Form --}}
                @foreach ($carts as $cart)
                    {{-- dummy form --}}
                  <form action="{{ $cart->id }}"></form>
                    {{-- Delete Form --}}
                  <form action="/cart/destroy/{{ $cart->id }}" class="del-cart" method="post">
                    @method('delete')
                    @csrf
                  </form>
                    {{-- QTY Plus Form --}}
                  <form action="/cart/edit/{{ $cart->id }}" class="plus-form" method="post">
                    @csrf
                    <input type="hidden" name="qty-plus">
                  </form>
                    {{-- QTY Minus Form --}}
                  <form action="/cart/edit/{{ $cart->id }}" class="min-form" method="post">
                    @csrf
                    <input type="hidden" name="qty-min">
                  </form>
                    {{-- Qty Override Form --}}
                  <form action="/cart/edit/{{ $cart->id }}" class="onchange-form" method="post">
                    @csrf
                    <input type="hidden" name="onchange" class="onchange">
                  </form>
                @endforeach
              </tbody>
            </table>
          </form>
        </div>
        
        <div class="cart-total">
          <div class="total-items">
            <p>Total produk : {{ $carts->count() }}</p>
          </div>
          <div class="total">
            <div>
              <h1 class="fw-bold fs-2 mb-2">Total : </h1>
              <h1 class="fw-bold fs-2 mb-2 total-price"></h1>
            </div>

            <div class="action">
              <form action="/cart/reset" method="post">
                @csrf
                <button class="btn reset fw-bold">Hapus Keranjang</button>
              </form>
              <!-- Button trigger modal -->
              <button type="button" class="btn co fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Proses
              </button>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="col-lg product">
      <h3 class="fw-bold fs-3 mb-2">Daftar Produk</h3>
      <div class="form">
        <form action="/" method="post" class="d-flex" role="search">
          @csrf
          <input class="form-control me-2 rounded" id="keyword" type="search" name="keyword" placeholder="Cari berdasarkan nama produk atau sku" aria-label="Search">
          <button class="btn btn-primary fw-bold" type="submit">Cari</button>
        </form> 
      </div>
      <div class="row product-list-wrapper border">
        @if ($products->count() > 0)
          @foreach ($products as $product)
              <div class="col-sm-2 p-0">
                <form action="/cart" method="post" class="add-to-cart">
                    @csrf
                      <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                      <div class="card border-2 {{ $product->stock === 0 ? 'border-danger disable' : '' }} {{ $product->stock <= 5 ? 'border-warning' : '' }}">
                        @if ($product->picture)
                              <img src="{{ asset('storage/'. $product->picture) }}" class="img-product img-thumbnail" alt="...">
                          @else
                              <img src="{{ asset('storage/img/noPict.jpg') }}" class="img-product img-thumbnail" alt="...">
                          @endif
                        <div class="barcode m-0 d-flex justify-content-between">
                          <small>
                            <strong>{{ $product->sku }}</strong>
                          </small>
                          <small>
                            <strong>{{ $product->stock }}</strong>
                          </small>
                        </div>
                        <div class="card-body p-0 m-0 text-center">
                          <p class="mt-0 px-1">{{ $product->product_name }}</p>
                          <p class="price"><b>{{ formatRp($product->price) }}</b></p>
                        </div>
                      </div>
                </form>
              </div>
          @endforeach
        @else
          <div class="text-center mt-5">
            <p class="mb-0">Belum ada produk.</p>
            <p>Tambah <a href="/product" class="text-decoration-none">Disini.</a></p>
          </div>    
        @endif
      </div>
  </div>
</div>    


@include('dashboard.transaction-modal')
@endsection

@section('script')
<script src="/js/dashboard.js"></script>
<script src="/js/easy-number-separator.js"></script>
<script>
  easyNumberSeparator({
      selector: '#discount',
      separator: '.',
      decimalSeparator: '.',
      resultInput: '#discountValue',
    });
  easyNumberSeparator({
      selector: '#total-payment',
      separator: '.',
      decimalSeparator: '.',
      resultInput: '#total-payment',
    });
</script>
@endsection