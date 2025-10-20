<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Kampus-APP')</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body { font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    .page-title { font-weight:700; margin-bottom:1rem; }
    .table thead th { vertical-align: middle; }
    .required { color: #d9534f; margin-left:4px; }
    .card { box-shadow: 0 4px 10px rgba(14,20,30,0.04); }
    .table td .btn { white-space: nowrap; }
    .table td { vertical-align: middle; }
  </style>

  @stack('styles')
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">Kampus-APP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"
              aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
              <i class="bi bi-people-fill"></i> Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}" href="{{ route('prodi.index') }}">
              <i class="bi bi-building"></i> Program Studi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('fakultas.*') ? 'active' : '' }}" href="{{ route('fakultas.index') }}">
              <i class="bi bi-collection"></i> Fakultas
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container my-4">
    @yield('content')
  </main>

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="deleteForm" method="POST" action="">
          @csrf
          @method('DELETE')

          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dikembalikan.</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="border-top py-3">
    <div class="container text-muted small">
      © {{ date('Y') }} Kampus-APP — dibuat untuk tugas Laravel
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('click', function (e) {
      const btn = e.target.closest('.btn-delete');
      if (!btn) return;
      const action = btn.dataset.action;
      const deleteForm = document.getElementById('deleteForm');
      if (deleteForm && action) deleteForm.action = action;
    });

    const confirmModalEl = document.getElementById('confirmDeleteModal');
    if (confirmModalEl) {
      confirmModalEl.addEventListener('hidden.bs.modal', function () {
        const deleteForm = document.getElementById('deleteForm');
        if (deleteForm) deleteForm.action = '';
      });
    }
  </script>

  @stack('scripts')
</body>
</html>
