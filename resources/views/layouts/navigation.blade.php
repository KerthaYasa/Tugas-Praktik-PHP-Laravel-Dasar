<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="z-index:2000">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Kampus-APP</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
            Mahasiswa
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('prodi*') ? 'active' : '' }}" href="{{ route('prodi.index') }}">
            Program Studi
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('fakultas*') ? 'active' : '' }}" href="{{ route('fakultas.index') }}">
            Fakultas
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userMenu" role="button" data-bs-toggle="dropdown" href="#">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('/profile') }}">Profil Saya</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
