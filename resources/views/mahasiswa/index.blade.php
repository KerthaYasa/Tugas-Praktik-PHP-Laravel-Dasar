@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="page-title">Daftar Mahasiswa</h2>

  <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
  </a>
</div>

{{-- Filter / Search --}}
<form class="row g-2 mb-3" method="GET" action="{{ route('mahasiswa.index') }}">
  <div class="col-md-5">
    <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari NIM atau Nama...">
  </div>

  <div class="col-md-3">
    <select name="fakultas_id" class="form-select">
      <option value="">-- Semua Fakultas --</option>
      @foreach($allFakultas as $f)
        <option value="{{ $f->id }}" {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
          {{ $f->nama_fakultas }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-3">
    <select name="prodi_id" class="form-select">
      <option value="">-- Semua Prodi --</option>
      @foreach($allProdi as $p)
        <option value="{{ $p->id }}" 
                data-fakultas-id="{{ $p->fakultas_id }}"
                {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
          {{ $p->nama_prodi }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-1 d-grid">
    <button class="btn btn-outline-secondary" type="submit">Filter</button>
  </div>
</form>

{{-- Success message --}}
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Table --}}
<div class="card">
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="table-light">
        <tr>
          <th style="width:60px">No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Prodi</th>
          <th>Fakultas</th>
          <th style="width:220px" class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($mahasiswa as $m)
          <tr>
            <td>{{ $mahasiswa->firstItem() + $loop->index }}</td>
            <td>{{ $m->nim }}</td>
            <td>{{ $m->nama }}</td>
            <td>{{ optional($m->prodi)->nama_prodi ?? '-' }}</td>
            <td>{{ optional($m->prodi->fakultas)->nama_fakultas ?? '-' }}</td>

            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('mahasiswa.show', $m->id) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>

                <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-sm btn-outline-success">
                  <i class="bi bi-pencil me-1"></i> Update
                </a>

                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal"
                        data-action="{{ route('mahasiswa.destroy', $m->id) }}"
                        data-name="{{ $m->nama }}">
                  <i class="bi bi-trash me-1"></i> Delete
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada data mahasiswa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Pagination --}}
<div class="mt-3">
  {{ $mahasiswa->withQueryString()->links() }}
</div>

{{-- Modal Konfirmasi Hapus --}}
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
          <p id="confirmDeleteText">Apakah Anda yakin ingin menghapus data ini?</p>
          <div class="text-muted small">Tindakan ini tidak dapat dibatalkan.</div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Modal Delete Script
  const modalEl = document.getElementById('confirmDeleteModal');
  if (modalEl) {
    modalEl.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      if (!button) return;

      const action = button.getAttribute('data-action') || '';
      const name = button.getAttribute('data-name') || '';
      const form = modalEl.querySelector('#deleteForm');
      const text = modalEl.querySelector('#confirmDeleteText');

      if (form && action) form.action = action;
      if (text) {
        if (name) {
          text.textContent = `Yakin ingin menghapus "${name}" dari data mahasiswa?`;
        } else {
          text.textContent = 'Apakah Anda yakin ingin menghapus data ini?';
        }
      }
    });
  }

  // Cascading Filter: Fakultas -> Prodi
  const fakultasFilter = document.querySelector('select[name="fakultas_id"]');
  const prodiFilter = document.querySelector('select[name="prodi_id"]');

  if (fakultasFilter && prodiFilter) {
    // Simpan semua option prodi beserta fakultas_id-nya
    const allProdiOptions = Array.from(prodiFilter.options).map(opt => ({
      value: opt.value,
      text: opt.text,
      fakultasId: opt.getAttribute('data-fakultas-id')
    }));

    fakultasFilter.addEventListener('change', function() {
      const selectedFakultas = this.value;
      
      // Reset prodi dropdown
      prodiFilter.innerHTML = '<option value="">-- Semua Prodi --</option>';
      
      // Filter dan tampilkan hanya prodi yang sesuai fakultas
      allProdiOptions.forEach(opt => {
        if (opt.value === '') {
          return; // Skip option "Semua Prodi"
        }
        
        // Tampilkan prodi jika: tidak ada fakultas dipilih ATAU fakultas cocok
        if (!selectedFakultas || opt.fakultasId === selectedFakultas) {
          const option = document.createElement('option');
          option.value = opt.value;
          option.text = opt.text;
          option.setAttribute('data-fakultas-id', opt.fakultasId);
          prodiFilter.appendChild(option);
        }
      });
    });
  }
});
</script>
@endpush

@endsection