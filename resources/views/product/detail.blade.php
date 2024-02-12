@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/product.css">
@endsection

@section('body')
    <div class="container-fluid mt-3">
        <div class="content-wrapper wrapper p-3 rounded rounded-3">
            <h3>Detail Produk</h3>

            <form action="/product/update/{{ $product->id }}" class="row mt-5 justify-content-center" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf
                <div class="col-md-6">
                    {{-- Product_name --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-input" id="inputGroup-sizing-default">Nama Produk</span>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="name" id="name" value="{{ $product->product_name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    {{-- Modal --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-input" id="inputGroup-sizing-default">Modal Pembelian</span>
                        <input type="number" class="form-control @error('modal') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="modal" id="modal" value="{{ $product->base_price }}">
                        @error('modal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-input" id="inputGroup-sizing-default">Harga Jual</span>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="price" id="price" value="{{ $product->price }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-input" id="inputGroup-sizing-default">Stok</span>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="stock" id="stock" value="{{ $product->stock }}">
                        @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- SKU --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-input" id="inputGroup-sizing-default">SKU</span>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="sku" id="sku" value="{{ $product->sku }}">
                        @error('sku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-5">
                    <div>
                        {{-- Picture --}}
                        @if ($product->picture)
                            <img src="{{ asset('storage/'. $product->picture) }}" class="img-product img-thumbnail" alt="...">
                        @else
                            <img src="{{ asset('img/noPict.jpg') }}" class="img-product img-thumbnail" alt="...">
                        @endif

                        {{-- Image Update Preview --}}
                        <div class="d-inline ms-2 img-update-prev d-none">
                            <i class="bi bi-caret-right-fill fs-1 text-light"></i>
                            <img src="{{ asset('img/noPict.jpg') }}" class="img-product img-thumbnail img-preview ms-2" alt="...">
                        </div>

                        {{-- Image Update input --}}
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-input" id="inputGroup-sizing-default">Ubah gambar</span>
                            <input type="hidden" name="oldPict" value="{{ $product->picture }}">
                            <input type="file" class="form-control @error('pict') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pict" id="pict" onchange="previewImage()">
                            @error('pict')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <p class="fs-6 m-0 warning">Disarankan untuk menggunakan gambar dengan aspek rasio 4:4.</p>
                        </div>
                        
                    </div>
                </div>

                <button class="btn btn-warning mt-3 col-sm-3 m-auto fw-bold">
                    <i class="bi bi-floppy2"></i>
                    Simpan Perubahan
                </button>
                <button class="btn btn-danger mt-3 col-sm-3 m-auto fw-bold btn-destroy">
                    <i class="bi bi-trash3-fill"></i>
                    Hapus
                </button>
            </form>

            <form action="/product/delete/{{ $product->id }}" method="post" id="destroy-form">
                @csrf
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/preview-image.js') }}"></script>
    <script src="{{ asset('js/product-destroy.js') }}"></script>
@endsection