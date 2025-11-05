@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-person-plus"></i> Edit Mahasiswa</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <!-- NIM -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">NIM</label>
            <input type="text" name="nim"
                   class="form-control @error('nim') is-invalid @enderror"
                   placeholder="Masukkan NIM"
                   value="{{ old('nim', $mahasiswa->nim) }}" required>
            @error('nim')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Nama -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Mahasiswa</label>
            <input type="text" name="nama"
                   class="form-control @error('nama') is-invalid @enderror"
                   placeholder="Masukkan nama mahasiswa"
                   value="{{ old('nama', $mahasiswa->nama) }}" required>
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Email -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Masukkan email mahasiswa"
                   value="{{ old('email', $mahasiswa->email) }}">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Telepon -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Telepon</label>
            <input type="text" name="telepon"
                   class="form-control @error('telepon') is-invalid @enderror"
                   placeholder="Masukkan nomor telepon"
                   value="{{ old('telepon', $mahasiswa->telepon) }}">
            @error('telepon')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Alamat -->
          <div class="col-md-12">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat"
                      class="form-control @error('alamat') is-invalid @enderror"
                      rows="2"
                      placeholder="Masukkan alamat">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
            @error('alamat')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Program Studi -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Program Studi</label>
            <select name="prodi_id" id="prodiSelect"
                    class="form-select @error('prodi_id') is-invalid @enderror" required>
              <option value="">-- Pilih Program Studi --</option>
              @foreach($prodi as $p)
                <option value="{{ $p->id }}"
                        data-fakultas="{{ $p->fakultas->nama_fakultas ?? '' }}"
                        {{ (int) old('prodi_id', $mahasiswa->prodi_id) === $p->id ? 'selected' : '' }}>
                  {{ $p->nama_prodi }}
                </option>
              @endforeach
            </select>
            @error('prodi_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Fakultas -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Fakultas</label>
            <input type="text" id="fakultasField"
                   class="form-control bg-light"
                   placeholder="Otomatis terisi berdasarkan Prodi"
                   value="{{ old('fakultas_name', $mahasiswa->prodi?->fakultas?->nama_fakultas ?? '') }}"
                   readonly>
          </div>
        </div>

        <!-- Tombol (Simpan biru, Kembali abu-abu) -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="{{ route('mahasiswa.index') }}" class="btn btn-light px-4 border">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Script otomatis isi fakultas berdasarkan prodi --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const prodiSelect = document.getElementById('prodiSelect');
  const fakultasField = document.getElementById('fakultasField');

  function fillFakultas() {
    const opt = prodiSelect.options[prodiSelect.selectedIndex];
    const fakultas = opt ? opt.getAttribute('data-fakultas') || '' : '';
    fakultasField.value = fakultas;
  }

  if (prodiSelect) {
    prodiSelect.addEventListener('change', fillFakultas);
    fillFakultas();
  }
});
</script>
@endsection
