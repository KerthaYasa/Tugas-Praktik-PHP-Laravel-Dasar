@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<style>
/* Custom CSS tombol aksi — seragam kayak Prodi */
.action-buttons .btn {
  font-size: 0.875rem;
  padding: 0.25rem 0.5rem;
  line-height: 1.5;
}

.action-buttons .btn i {
  font-size: 0.875rem;
  margin-right: 4px;
}
</style>

<div class="container mt-4">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
      <span>Daftar Mahasiswa</span>
      @if(auth()->user() && (method_exists(auth()->user(), 'isAdmin') ? auth()->user()->isAdmin() : (auth()->user()->role ?? '') === 'admin'))
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-light btn-sm">
          <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
        </a>
      @endif
    </div>

    <div class="card-body">
      {{-- Search + Filters --}}
      <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-3" id="filterForm">
        <div class="row g-2">
          <div class="col-md-5">
            <div class="input-group">
              <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari NIM atau Nama...">
              <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </div>

          <div class="col-md-3">
            <select name="fakultas_id" id="fakultasFilter" class="form-select">
              <option value="">-- Semua Fakultas --</option>
              @foreach($allFakultas as $f)
                <option value="{{ $f->id }}" {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                  {{ $f->nama_fakultas }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <select name="prodi_id" id="prodiFilter" class="form-select">
              <option value="">-- Semua Prodi --</option>
              @foreach($allProdi as $p)
                <option value="{{ $p->id }}" data-fakultas-id="{{ $p->fakultas_id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->nama_prodi }} ({{ optional($p->fakultas)->nama_fakultas ?? '-' }})
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </form>

      {{-- Flash message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Table --}}
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th class="text-center" style="width: 5%;">No</th>
              <th style="width: 15%;">NIM</th>
              <th style="width: 25%;">Nama</th>
              <th style="width: 20%;">Program Studi</th>
              <th style="width: 15%;">Fakultas</th>
              @if(auth()->user() && (method_exists(auth()->user(), 'isAdmin') ? auth()->user()->isAdmin() : (auth()->user()->role ?? '') === 'admin'))
                <th class="text-center" style="width: 25%;">Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($mahasiswa as $m)
              <tr>
                <td class="text-center">{{ $mahasiswa->firstItem() ? $mahasiswa->firstItem() + $loop->index : $loop->iteration }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ optional($m->prodi)->nama_prodi ?? '-' }}</td>
                <td>{{ optional(optional($m->prodi)->fakultas)->nama_fakultas ?? '-' }}</td>

                @if(auth()->user() && (method_exists(auth()->user(), 'isAdmin') ? auth()->user()->isAdmin() : (auth()->user()->role ?? '') === 'admin'))
                <td class="text-center" style="width: 35%;">
                <div class="d-flex justify-content-center align-items-center gap-2 action-buttons">
                    <a href="{{ route('mahasiswa.show', $m->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye"></i> View
                    </a>
                    <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline delete-form">
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
              <tr>
                <td colspan="{{ (auth()->user() && (method_exists(auth()->user(), 'isAdmin') ? auth()->user()->isAdmin() : (auth()->user()->role ?? '') === 'admin')) ? 6 : 5 }}" class="text-center text-muted py-4">
                  Tidak ada data mahasiswa.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end mt-3">
        {{ $mahasiswa->withQueryString()->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const fakultasSelect = document.getElementById('fakultasFilter');
  const prodiSelect = document.getElementById('prodiFilter');

  const prodiOptions = Array.from(prodiSelect.options).map(opt => ({
    value: opt.value,
    text: opt.text,
    fakultasId: opt.getAttribute('data-fakultas-id') || ''
  }));

  function rebuildProdiOptions(fakultasId, preserveSelected = true) {
    const current = prodiSelect.value;
    prodiSelect.innerHTML = '<option value="">-- Semua Prodi --</option>';
    prodiOptions.forEach(o => {
      if (!o.value) return;
      if (!fakultasId || o.fakultasId === fakultasId) {
        const el = document.createElement('option');
        el.value = o.value;
        el.text = o.text;
        el.setAttribute('data-fakultas-id', o.fakultasId);
        prodiSelect.appendChild(el);
      }
    });
    if (preserveSelected && current) {
      const still = Array.from(prodiSelect.options).find(op => op.value === current);
      if (still) prodiSelect.value = current;
      else prodiSelect.value = '';
    }
  }

  fakultasSelect && fakultasSelect.addEventListener('change', function() {
    const fid = this.value || '';
    rebuildProdiOptions(fid, true);
  });

  prodiSelect && prodiSelect.addEventListener('change', function() {
    const pid = this.value;
    if (!pid) return;
    const found = prodiOptions.find(o => o.value === pid);
    if (found && found.fakultasId) {
      fakultasSelect.value = found.fakultasId;
      rebuildProdiOptions(found.fakultasId, true);
    }
  });

  (function initFilters() {
    const selectedFakultas = "{{ request('fakultas_id') }}" || '';
    const selectedProdi = "{{ request('prodi_id') }}" || '';

    if (selectedFakultas) {
      fakultasSelect.value = selectedFakultas;
      rebuildProdiOptions(selectedFakultas, true);
    } else {
      rebuildProdiOptions('', true);
    }

    if (!selectedFakultas && selectedProdi) {
      const f = prodiOptions.find(o => o.value === selectedProdi);
      if (f && f.fakultasId) {
        fakultasSelect.value = f.fakultasId;
        rebuildProdiOptions(f.fakultasId, true);
        prodiSelect.value = selectedProdi;
      }
    }
  })();

  // Konfirmasi hapus
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const f = this;
      Swal.fire({
        title: 'Hapus Mahasiswa?',
        text: 'Data mahasiswa akan dihapus permanen.',
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
