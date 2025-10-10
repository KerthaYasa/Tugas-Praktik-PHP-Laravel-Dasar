@extends('layouts.app')

@section('title','Detail Mahasiswa')

@section('content')
  <h2 class="page-title">Detail Mahasiswa</h2>

  <div class="card p-3">
    <p><strong>NIM:</strong> {{ $m->nim }}</p>
    <p><strong>Nama:</strong> {{ $m->nama }}</p>
    <p><strong>Prodi:</strong> {{ $m->prodi }}</p>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Kembali</a>
    <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-success">Edit</a>
  </div>
@endsection
