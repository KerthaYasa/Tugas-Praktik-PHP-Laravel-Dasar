@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tambah Mahasiswa</h5>
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
    <div class="card-body">
      <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" name="nama_mahasiswa" class="form-control" value="{{ old('nama_mahasiswa') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Program Studi</label>
          <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodi as $p)
              <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                {{ $p->nama_prodi }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">
            <i
