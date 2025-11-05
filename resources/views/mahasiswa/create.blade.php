@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-person-plus"></i> Tambah Mahasiswa</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">NIM</label>
            <input type="text" name="nim" 
                   class="form-control @error('nim') is-invalid @enderror" 
                   placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
            @error('nim')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Mahasiswa</label>
            <input type="text" name="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   placeholder="Masukkan nama mahasiswa" value="{{ old('nama') }}" required>
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Masukkan email mahasiswa" value="{{ old('email') }}">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Telepon</label>
            <input type="text" name="telepon" 
                   class="form-control @error('telepon') is-invalid @enderror" 
                   placeholder="Masukkan nomor telepon" value="{{ old('telepon') }}">
            @error('telepon')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" 
                      class="form-control @error('alamat') is-invalid @enderror" 
                      rows="2" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
            @error('alamat')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Program Studi</label>
            <select name="prodi_id" id="prodiSelect" 
                    class="form-select @error('prodi_id') is-invalid @enderror" required>
              <option value="">-- Pilih Program Studi --</option>
              @foreach($prodi as $p)
                <option value="{{ $p->id }}" data-fakultas="{{ $p->fakultas->nama_fakultas ?? '' }}"
                        {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->nama_prodi }}
                </option>
              @endforeach
            </select>
            @error('prodi_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Fakultas</label>
            <input type="text" id="fakultasField" 
                   class="form-control bg-light" 
                   placeholder="Otomatis terisi berdasarkan Prodi" readonly>
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="{{ route('mahasiswa.index') }}" class="btn btn-light px-4">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Script otomatis isi fakultas berdasarkan prodi --}}
<script>
document.getElementById('prodiSelect').addEventListener('change', function() {
  const selected = this.options[this.selectedIndex];
  const fakultasName = selected.getAttribute('data-fakultas') || '';
  document.getElementById('fakultasField').value = fakultasName;
});

window.addEventListener('DOMContentLoaded', function() {
  const prodiSelect = document.getElementById('prodiSelect');
  if (prodiSelect.value) prodiSelect.dispatchEvent(new Event('change'));
});
</script>
@endsection
