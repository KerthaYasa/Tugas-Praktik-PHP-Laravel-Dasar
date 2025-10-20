@extends('layouts.app')

@section('title', 'Daftar Fakultas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="page-title">Daftar Fakultas</h2>
  <a href="{{ route('fakultas.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg"></i> Tambah Fakultas
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 60px;">No</th>
          <th>Nama Fakultas</th>
          <th>Dekan</th>
          <th>Jumlah Prodi</th>
          <th class="text-center" style="width: 220px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($fakultas as $f)
          <tr>
            <td>{{ $fakultas->firstItem() + $loop->index }}</td>
            <td>{{ $f->nama_fakultas }}</td>
            <td>{{ $f->dekan ?? '-' }}</td>
            <td>{{ $f->prodi->count() }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('fakultas.show', $f->id) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
                <a href="{{ route('fakultas.edit', $f->id) }}" class="btn btn-sm btn-outline-success">
                  <i class="bi bi-pencil me-1"></i> Update
                </a>
                <button type="button" class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal"
                        data-action="{{ route('fakultas.destroy', $f->id) }}"
                        data-name="{{ $f->nama_fakultas }}">
                  <i class="bi bi-trash me-1"></i> Delete
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-4">
              Belum ada data fakultas.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Hapus pagination kalau tidak perlu --}}
{{-- <div class="mt-3">{{ $fakultas->links() }}</div> --}}

{{-- Modal Konfirmasi --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="deleteForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('confirmDeleteModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const action = button.getAttribute('data-action');
    const name = button.getAttribute('data-name');
    const form = modal.querySelector('#deleteForm');
    const body = modal.querySelector('.modal-body p');

    form.action = action;
    body.textContent = `Yakin ingin menghapus "${name}"?`;
  });
});
</script>
@endsection
