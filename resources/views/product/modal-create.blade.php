<div class="modal fade" id="modalcreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalcreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
  
        <form action="/product" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalcreateLabel">Tambah Produk</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            {{-- Product_name --}}
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">Nama Produk</span>
              <input type="text" class="form-control @error('name') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="name" id="name">
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- Modal --}}
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">Harga Beli</span>
              <input type="number" class="form-control @error('modal') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="modal" id="modal">
              @error('modal')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- Price --}}
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">Harga Jual</span>
              <input type="number" class="form-control @error('price') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="price" id="price">
              @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- Stock --}}
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">Stok</span>
              <input type="number" class="form-control @error('stock') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="stock" id="stock">
              @error('stock')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- SKU --}}
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">SKU</span>
              <input type="text" class="form-control @error('sku') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="sku" id="sku">
              @error('sku')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- Picture --}}
            <p class="fs-6 m-0 text-warning">Disarankan untuk menggunakan gambar dengan aspek rasio 4:4</p>
            <img src="" alt="" class="img-preview img-thumbnail col-sm-4 my-2">
            <div class="input-group mb-3">
              <span class="input-group-text bg-input" id="inputGroup-sizing-default">Gambar (Opsional)</span>
              <input type="file" class="form-control @error('pict') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pict" id="pict"  onchange="previewImage()">
              @error('pict')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
  
      </div>
    </div>
</div>