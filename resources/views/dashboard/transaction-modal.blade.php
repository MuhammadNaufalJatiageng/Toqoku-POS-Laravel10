<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Informasi Tambahan</h1>
        </div>
        <div class="modal-body">
          <form action="/purchase" method="post" class="co-form">
            @csrf
            @if ($carts->count() > 0)
                @foreach ($carts as $cart)
                <input type="hidden" name="product_id[]" value="{{ $cart->product->id }}">
                <input type="hidden" name="qty[]" value="{{ $cart->quantity }}">
                <input type="hidden" name="subtotal[]" class="total-item">
                @endforeach
            @endif

            <section class="row">
              <div class="col-sm p-3 divide-2">
                <label for="discount" class="mb-2"><h5>Diskon</h5></label>
                <div class="mb-3 d-flex justify-content-between">
                  <a class="btn btn-light border border-2" onclick="discount('2%')">2%</a>
                  <a class="btn btn-light border border-2" onclick="discount('5%')">5%</a>
                  <a class="btn btn-light border border-2" onclick="discount('10%')">10%</a>
                  <a class="btn btn-light border border-2" onclick="discount('5k')">5.000</a>
                  <a class="btn btn-light border border-2" onclick="discount('10k')">10.000</a>
                </div>
                <div class="mb-3">
                    <input type="text" id="discount" class="form-control border-2 mt-2" onchange="getTotal()">
                    <input type="hidden" name="discountValue" id="discountValue">
                </div>
                
              </div>
  
              <div class="col-sm divide p-3">
                <label for="total-payment" class="mb-2"><h5>Nominal Pembayaran</h5></label>
                <div class="mb-3 d-flex justify-content-between">
                  <a class="btn btn-light border border-2" onclick="getInputChange('10k')">10.000</a>
                  <a class="btn btn-light border border-2" onclick="getInputChange('20k')">20.000</a>
                  <a class="btn btn-light border border-2" onclick="getInputChange('50k')">50.000</a>
                  <a class="btn btn-light border border-2" onclick="getInputChange('100k')">100.000</a>
                </div>
                <div class="mb-3">
                    <input type="text" id="total-payment" name="total-payment" class="form-control border-2 mt-2" onchange="getChange()">
                </div>
              </div>
            </section>

            <div class="my-3">
              <label for="customer">Nama Pelanggan</label>
              <input type="text" id="customer" name="customer" class="form-control border-2 mt-2">
            </div>

            <table class="w-100 mx-2">
              <tbody>
                <tr>
                  <td class="col-sm-4"><h3>Total</h3></td>
                  <td class="col-sm-1"><h3>:</h3></td>
                  <td class="text-end"><h3 class="total-price"></h3></td>
                </tr>
                <tr>
                  <td class="col-sm-4"><h3>Uang Kembali</h3></td>
                  <td class="col-sm-1"><h3>:</h3></td>
                  <td class="text-end"><h3 class="total-change">0</h3></td>
                </tr>
              </tbody>
            </table>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload()">Batal</button>
          <button type="submit" class="btn btn-success proses" onclick="submitForm('.co-form')">Proses</button>
        </div>
      </div>
    </div>
</div>