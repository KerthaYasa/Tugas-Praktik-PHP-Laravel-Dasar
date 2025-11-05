{{-- resources/views/prodi/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-building"></i> Tambah Program Studi</h5>
      {{-- tombol kembali di header dihilangkan karena kamu mau di baris yang sama dengan simpan --}}
      <div></div>
    </div>

    <div class="card-body">
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form action="{{ route('prodi.store') }}" method="POST">
        @csrf

        <div class="row g-3">
          {{-- Kode Prodi (satu baris penuh) --}}
          <div class="col-12">
            <label class="form-label fw-semibold">Kode Prodi <span class="text-danger">*</span></label>
            <input type="text" name="kode_prodi"
                   class="form-control @error('kode_prodi') is-invalid @enderror"
                   placeholder="Misal: TI" value="{{ old('kode_prodi') }}" required>
            @error('kode_prodi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Nama Prodi (satu baris penuh) --}}
          <div class="col-12">
            <label class="form-label fw-semibold">Nama Program Studi <span class="text-danger">*</span></label>
            <input type="text" name="nama_prodi"
                   class="form-control @error('nama_prodi') is-invalid @enderror"
                   placeholder="Misal: Teknologi Informasi" value="{{ old('nama_prodi') }}" required>
            @error('nama_prodi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Fakultas (satu baris penuh) --}}
          <div class="col-12">
            <label class="form-label fw-semibold">Fakultas <span class="text-danger">*</span></label>
            <select name="fakultas_id"
                    class="form-select @error('fakultas_id') is-invalid @enderror" required>
              <option value="">-- Pilih Fakultas --</option>
              @foreach($fakultas as $f)
                <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                  {{ $f->nama_fakultas }}
                </option>
              @endforeach
            </select>
            @error('fakultas_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- tombol Simpan lalu sedikit gap lalu Kembali, keduanya di kanan bawah --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save"></i> Simpan
          </button>

          {{-- jarak kecil sudah diberikan oleh gap-2 --}}
          <a href="{{ route('prodi.index') }}" class="btn btn-light px-4">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
