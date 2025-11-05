@extends('layouts.app')

@section('title', 'Daftar Fakultas')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <span class="fw-bold">Daftar Fakultas</span>

      @if(auth()->user()->isAdmin() ?? (auth()->user()->role ?? '') === 'admin')
        <a href="{{ route('fakultas.create') }}" class="btn btn-light btn-sm">
          <i class="bi bi-plus-circle me-1"></i> Tambah Fakultas
        </a>
      @endif
    </div>

    <div class="card-body">
      {{-- Search --}}
      <form action="{{ route('fakultas.index') }}" method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama atau kode fakultas...">
          <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        </div>
      </form>

      {{-- Table --}}
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th class="text-center" style="width:5%;">No</th>
              <th style="width:20%;">Kode Fakultas</th>
              <th>Nama Fakultas</th>
              <th class="text-center" style="width:15%;">Jumlah Prodi</th>
              @if(auth()->user()->isAdmin() ?? (auth()->user()->role ?? '') === 'admin')
                <th class="text-center" style="width:30%;">Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($fakultas as $f)
              <tr>
                <td class="text-center">{{ $fakultas->firstItem() ? $fakultas->firstItem() + $loop->index : $loop->iteration }}</td>
                <td>{{ $f->kode_fakultas }}</td>
                <td>{{ $f->nama_fakultas }}</td>
                <td class="text-center">{{ $f->prodi->count() ?? 0 }}</td>

                @if(auth()->user()->isAdmin() ?? (auth()->user()->role ?? '') === 'admin')
                  <td class="text-center">
                    <div class="d-inline-flex gap-2 justify-content-center">
                      <a href="{{ route('fakultas.show', $f->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye"></i> View
                      </a>
                      <a href="{{ route('fakultas.edit', $f->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-pencil-square"></i> Update
                      </a>
                      <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                          <i class="bi bi-trash"></i> Delete
                        </button>
                      </form>
                    </div>
                  </td>
                @endif
              </tr>
            @empty
              <tr><td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="text-center text-muted">Tidak ada data</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end mt-3">
        {{ $fakultas->withQueryString()->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const f = this;
      Swal.fire({
        title: 'Hapus Fakultas?',
        text: 'Semua prodi terkait akan terhapus (jika cascade). Lanjutkan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
      }).then(res => {
        if (res.isConfirmed) f.submit();
      });
    });
  });
});
</script>
@endpush
@endsection
