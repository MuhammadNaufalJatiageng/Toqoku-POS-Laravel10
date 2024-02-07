<nav class="navbar navbar-expand-lg position-fixed top-0 end-0 start-0">
    <div class="container align-items-center justify-content-start nav">
        <a class="navbar-brand">
            <img src="{{ asset('storage/img/toqoku-full.png') }}" alt="Bootstrap" width="100">
        </a>    
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="mx-5" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-1">
            <a class="nav-link fw-bold rounded rounded-2{{ Request::is('/') ? 'active activate' : '' }}" aria-current="page" href="/">Halaman Utama</a>
          </li>
          <li class="nav-item me-1">
            <a class="nav-link fw-bold rounded rounded-2{{ Request::is('product*') ? 'active activate' : '' }}" href="/product">Produk</a>
          </li>
          <li class="nav-item me-1">
            <a class="nav-link fw-bold rounded rounded-2{{ Request::is('transaction*') ? 'active activate' : '' }}" href="/transaction">Transaksi</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold rounded rounded-2{{ Request::is('profile*') ? 'active activate' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->store->store_name }}
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item fw-bold" href="{{ route('profile.edit') }}">
                  <i class="bi bi-person-circle me-2"></i>
                  Informasi Akun
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="dropdown-item fw-bold logout"
                  onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Keluar
                  </a>
              </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      
      {{-- ALERT --}}
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
    </div>
</nav>