@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show py-2 m-0" role="alert">
        <strong>Perhatian! </strong>{{ session('warning') }}
        <button type="button" class="btn-close button-close py-3 " data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show py-2 m-0" role="alert">
        <strong>Sukses! </strong>{{ session('success') }}
        <button type="button" class="btn-close button-close py-3 " data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('fail'))
    <div class="alert alert-danger alert-dismissible fade show py-2 m-0" role="alert">
        <strong>Error! </strong>{{ session('fail') }}
        <button type="button" class="btn-close button-close py-3 " data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif