@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h4 class="fw-bold mb-4">Pengaturan Akun</h4>

  {{-- Tabs Navigasi --}}
  <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab">Profil</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">Ubah Password</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="hapus-tab" data-bs-toggle="tab" data-bs-target="#hapus" type="button" role="tab">Hapus Akun</button>
    </li>
  </ul>

  <div class="tab-content" id="profileTabsContent">
    {{-- TAB PROFIL --}}
    <div class="tab-pane fade show active" id="profil" role="tabpanel">
      @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Profil berhasil diperbarui!
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form method="post" action="{{ route('profile.update') }}" class="card shadow-sm p-4">
        @csrf
        @method('patch')

        <div class="mb-3">
          <label for="name" class="form-label fw-semibold">Nama</label>
          <input id="name" name="name" type="text" class="form-control" 
                 value="{{ old('name', $user->name) }}" required autofocus>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email</label>
          <input id="email" name="email" type="email" class="form-control" 
                 value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-save me-1"></i> Simpan Perubahan
        </button>
      </form>
    </div>

    {{-- TAB PASSWORD --}}
    <div class="tab-pane fade" id="password" role="tabpanel">
      @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          Password berhasil diperbarui!
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form method="post" action="{{ route('password.update') }}" class="card shadow-sm p-4 mt-3">
        @csrf
        @method('put')

        <div class="mb-3">
          <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
          <input id="current_password" name="current_password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password Baru</label>
          <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
          <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">
          <i class="bi bi-key me-1"></i> Ubah Password
        </button>
      </form>
    </div>

    {{-- TAB HAPUS AKUN --}}
    <div class="tab-pane fade" id="hapus" role="tabpanel">
      <div class="card shadow-sm p-4 mt-3">
        <h5 class="fw-bold text-danger">Hapus Akun</h5>
        <p>Setelah akun dihapus, semua data akan hilang secara permanen.</p>

        <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-danger w-100" id="confirmDeleteBtn">
            <i class="bi bi-trash3 me-1"></i> Hapus Akun
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
  Swal.fire({
    title: 'Yakin ingin menghapus akun?',
    text: "Tindakan ini tidak bisa dibatalkan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, hapus akun!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('deleteAccountForm').submit();
    }
  });
});
</script>
@endpush
@endsection
