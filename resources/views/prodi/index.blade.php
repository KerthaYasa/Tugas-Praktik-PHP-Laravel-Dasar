@extends('layouts.app')

@section('title', 'Daftar Prodi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="page-title">Daftar Program Studi</h2>
  <a href="{{ route('prodi.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg"></i> Tambah Prodi
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:60px;">No</th>
          <th>Program Studi</th>
          <th>Ketua Program Studi</th>
          <th>Fakultas</th>
          <th style="width:130px;" class="text-center">Jumlah Mahasiswa</th>
          <th style="width:220px;" class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($prodi as $p)
          <tr>
            <td>{{ $prodi->firstItem() + $loop->index }}</td>
            <td>{{ $p->nama_prodi }}</td>
            <td>{{ $p->kaprodi ?? '-' }}</td>
            <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
            <td class="text-center">{{ $p->mahasiswa_count ?? ($p->mahasiswa->count() ?? 0) }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2 flex-nowrap">
                <a href="{{ route('prodi.show', $p->id) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
                <a href="{{ route('prodi.edit', $p->id) }}" class="btn btn-sm btn-outline-success">
                  <i class="bi bi-pencil me-1"></i> Update
                </a>
                <button type="button" class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal"
                        data-action="{{ route('prodi.destroy', $p->id) }}"
                        data-name="{{ $p->nama_prodi }}">
                  <i class="bi bi-trash me-1"></i> Delete
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada data prodi.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

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
          <p id="confirmDeleteBody">Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('styles')
<style>
  /* Biar tombol tetap horizontal dan tidak menumpuk */
  .table .btn { white-space: nowrap; }
  /* Tabel rapi tanpa teks bold di body */
  .table td, .table th { vertical-align: middle; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('confirmDeleteModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const action = button.getAttribute('data-action');
    const name = button.getAttribute('data-name');
    const form = modal.querySelector('#deleteForm');
    const body = modal.querySelector('#confirmDeleteBody');

    form.action = action;
    body.textContent = `Yakin ingin menghapus prodi "${name}"?`;
  });
});
</script>
@endpush

@endsection
