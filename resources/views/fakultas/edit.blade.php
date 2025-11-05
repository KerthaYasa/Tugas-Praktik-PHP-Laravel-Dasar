@extends('layouts.app')

@section('title', 'Edit Fakultas')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-building"></i> Edit Fakultas</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
          {{-- Baris 1: Kode Fakultas --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold">Kode Fakultas</label>
            <input type="text" name="kode_fakultas" class="form-control @error('kode_fakultas') is-invalid @enderror"
                   value="{{ old('kode_fakultas', $fakultas->kode_fakultas) }}" placeholder="Contoh: FK" required>
            @error('kode_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- Baris 2: Nama Fakultas --}}
          <div class="col-md-12">
            <label class="form-label fw-semibold">Nama Fakultas</label>
            <input type="text" name="nama_fakultas" class="form-control @error('nama_fakultas') is-invalid @enderror"
                   value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}" placeholder="Nama Fakultas" required>
            @error('nama_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- Tombol Simpan dan Kembali --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
