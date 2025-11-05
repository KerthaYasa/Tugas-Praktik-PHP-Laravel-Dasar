<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Kampus-APP') }}</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      background-color: #f8fafc;
      font-family: 'Inter', system-ui, sans-serif;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      min-height: calc(100vh - 120px); /* biar footer nempel di bawah */
    }

    .navbar {
      background-color: #fff;
      border-bottom: 1px solid #e5e7eb;
    }

    .navbar-brand {
      font-weight: 700;
      color: #0d6efd !important;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-link {
      color: #374151 !important;
      padding: 8px 12px;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background-color: #f1f5ff;
      color: #0d6efd !important;
    }

    .nav-link.active {
      background-color: #e9f2ff;
      color: #0d6efd !important;
      font-weight: 600;
    }

    footer {
      text-align: center;
      padding: 15px;
      color: #6c757d;
      border-top: 1px solid #dee2e6;
      background: #fff;
    }

    .btn-sm.action-btn {
      min-width: 86px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      padding: 0.3rem 0.6rem;
      border-radius: 6px;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('dashboard') }}">
        <i class="bi bi-mortarboard-fill"></i> Kampus-APP
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto ms-4">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
              Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}" href="{{ route('prodi.index') }}">
              Program Studi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('fakultas.*') ? 'active' : '' }}" href="{{ route('fakultas.index') }}">
              Fakultas
            </a>
          </li>
        </ul>

        <ul class="navbar-nav">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  {{-- Content --}}
  <main class="flex-grow-1 container py-4">
    @yield('content')
  </main>

{{-- Footer --}}
  <footer class="mt-auto">
    © {{ date('Y') }} Kampus-APP — dibuat untuk tugas Laravel (Cahya)
  </footer>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Setup CSRF for AJAX if needed
    window.Laravel = { csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content') };

    // Global SweetAlert2 delete confirmation for forms with class .delete-form
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.delete-form').forEach(function(form){
        form.addEventListener('submit', function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Data akan dihapus permanen. Lanjutkan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      });
    });
  </script>

  @stack('scripts')
</body>
</html>
