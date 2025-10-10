@extends('layouts.app')

@section('title','Daftar Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="page-title">Daftar Mahasiswa</h2>
  <div>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
    </a>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <form class="d-flex" method="GET" action="{{ route('mahasiswa.index') }}">
      <input name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Cari NIM atau Nama...">
      <button class="btn btn-outline-secondary me-2" type="submit">
        <i class="bi bi-search"></i>
      </button>

      {{-- Tombol reset muncul kalau ada query pencarian --}}
      @if(request('q'))
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-dark">
          <i class="bi bi-arrow-counterclockwise"></i>
        </a>
      @endif
    </form>
  </div>
</div>

<!-- Alerts -->
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr>
          <th style="width:60px">#</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Prodi</th>
          <th style="width:170px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($mahasiswa as $m)
          <tr>
            <td>{{ $loop->iteration + ($mahasiswa->firstItem() - 1) }}</td>
            <td>{{ $m->nim }}</td>
            <td>{{ $m->nama }}</td>
            <td>{{ $m->prodi }}</td>
            <td>
              <div class="d-flex gap-2 align-items-center">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('mahasiswa.show', $m->id) }}">
                  <i class="bi bi-eye"></i> Lihat
                </a>

                <a class="btn btn-sm btn-outline-success" href="{{ route('mahasiswa.edit', $m->id) }}">
                  <i class="bi bi-pencil"></i> Edit
                </a>

                <!-- tombol hapus: buka modal, simpan route destroy di data-action -->
                <button
                  type="button"
                  class="btn btn-sm btn-outline-danger btn-delete"
                  data-bs-toggle="modal"
                  data-bs-target="#confirmDeleteModal"
                  data-action="{{ route('mahasiswa.destroy', $m->id) }}"
                >
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-muted">Belum ada data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $mahasiswa->withQueryString()->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteForm = document.getElementById('deleteForm');
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
      const action = this.getAttribute('data-action');
      if (action && deleteForm) {
        deleteForm.setAttribute('action', action);
      }
    });
  });

  const modalEl = document.getElementById('confirmDeleteModal');
  if (modalEl) {
    modalEl.addEventListener('hidden.bs.modal', function () {
      if (deleteForm) deleteForm.setAttribute('action', '');
    });
  }
});
</script>
@endpush
