<nav class="nav-top">
    <section class="brand">
      <img src="{{ asset('/storage/img/toqoku-full.png') }}" alt="">
    </section>

    <section class="menu">
        <ul>
            <li>
                <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
                  Transaksi
                </a>
            </li>
            <li>
                <a href="/product" class="{{ Request::is('product*') ? 'active' : '' }}">
                  Produk
                </a>
            </li>
            <li>
                <a href="/transaction" class="{{ Request::is('transaction*') ? 'active' : '' }}">
                  Keuangan
                </a>
            </li>
            <li class="nav-dropdown" onclick="dropdownOpen()">
              <a href="#" class="{{ Request::is('profile*') ? 'active' : '' }}">
                {{ auth()->user()->store->store_name }}
                <i class="bi bi-caret-down-fill fs-6"></i>
              </a>
              @include('components.nav-dropdown-menu')
            </li>
        </ul>
    </section>

    <section>
      @include('components.nav-alert')
    </section>
</nav>

{{-- NavBar Bottom --}}

<section class="alert-nav-bottom">
  
  @include('components.nav-alert')
</section>

<nav class="nav-bottom">

  <section class="menu">
      <ul>
          <li>
            <a href="/">
              <i class="bi bi-calculator-fill {{ Request::is('/') ? 'activeIcon' : '' }}"></i>
            </a>
          </li>
          <li>
            <a href="/product">
              <i class="bi bi-box2-fill {{ Request::is('product*') ? 'activeIcon' : '' }}" ></i>
            </a>
          </li>
          <li>
            <a href="/transaction">
              <i class="bi bi-bank2 {{ Request::is('transaction*') ? 'activeIcon' : '' }}"></i>
            </a>
          </li>
          <li class="nav-dropdown" onclick="dropdownOpen()">
            <div class="d-flex align-items-center">
              <i class="bi bi-person-circle me- {{ Request::is('profile*') ? 'activeIcon' : '' }}"></i>
            </div>
            @include('components.nav-dropdown-menu')
          </li>
      </ul>
  </section>

</nav>