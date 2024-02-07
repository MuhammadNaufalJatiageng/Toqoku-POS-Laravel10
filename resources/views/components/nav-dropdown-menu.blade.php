<ul class="nav-dropdown-menu">
    <li class="nav-dropdown-item m-0">
      <div class="profile-info">
        <i class="bi bi-person-circle fs-5 me-2"></i>
        <a href="{{ route('profile.edit') }}" class="fw-bold">Informasi Lainnya</a>
      </div>
    </li>
    <div class="divide-3"></div>
    <li class="nav-dropdown-item m-0">
      <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
          @csrf 
          <i class="bi bi-box-arrow-right fs-5 me-2"></i>
          <a class="fw-bold" href="#" onclick="event.preventDefault();this.closest('form').submit();">
            Keluar
          </a>
        </form>
      </div>
    </li>
  </ul>