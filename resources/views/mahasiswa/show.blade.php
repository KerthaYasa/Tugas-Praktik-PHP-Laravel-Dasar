@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="card shadow border-0 rounded-3">
  <div class="card-header bg-primary text-white d-flex align-items-center">
    <i class="bi bi-person-vcard fs-4 me-2"></i>
    <h5 class="mb-0">Detail Mahasiswa</h5>
  </div>

  <div class="card-body">
    <table class="table table-borderless mb-4">
      <tr><th style="width: 180px;">NIM</th><td>{{ $mahasiswa->nim }}</td></tr>
      <tr><th>Nama</th><td>{{ $mahasiswa->nama }}</td></tr>
      <tr><th>Program Studi</th><td>{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</td></tr>
      <tr><th>Fakultas</th><td>{{ $mahasiswa->prodi->fakultas->nama_fakultas ?? '-' }}</td></tr>
      <tr><th>Email</th><td>{{ $mahasiswa->email ?? '-' }}</td></tr>
      <tr><th>Telepon</th><td>{{ $mahasiswa->telepon ?? '-' }}</td></tr>
      <tr><th>Alamat</th><td>{{ $mahasiswa->alamat ?? '-' }}</td></tr>
      <tr><th>Dibuat Pada</th><td>{{ optional($mahasiswa->created_at)->format('d M Y, H:i') ?? '-' }}</td></tr>
      <tr><th>Terakhir Diperbarui</th><td>{{ optional($mahasiswa->updated_at)->format('d M Y, H:i') ?? '-' }}</td></tr>
    </table>

    <div class="d-flex justify-content-end gap-2">
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-primary">
          <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
      @endif
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-light border">
        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
      </a>
    </div>
  </div>
</div>
@endsection
