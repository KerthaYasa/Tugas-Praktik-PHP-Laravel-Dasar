@extends('layouts.app')

@section('title', 'Edit Program Studi')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Program Studi</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
          {{-- Baris 1: Kode Prodi --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold">Kode Prodi</label>
            <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror"
                   placeholder="Masukkan kode prodi"
                   value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
            @error('kode_prodi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Baris 2: Nama Program Studi --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold">Nama Program Studi</label>
            <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror"
                   placeholder="Masukkan nama program studi"
                   value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
            @error('nama_prodi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Baris 3: Fakultas --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold">Fakultas</label>
            <select name="fakultas_id" class="form-select @error('fakultas_id') is-invalid @enderror" required>
              <option value="">-- Pilih Fakultas --</option>
              @foreach($fakultas as $f)
                <option value="{{ $f->id }}" {{ old('fakultas_id', $prodi->fakultas_id) == $f->id ? 'selected' : '' }}>
                  {{ $f->nama_fakultas }}
                </option>
              @endforeach
            </select>
            @error('fakultas_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- Tombol Simpan dan Kembali --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
