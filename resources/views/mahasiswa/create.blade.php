@extends('layouts.app')

@section('title','Tambah Mahasiswa')

@section('content')
  <h2 class="page-title">Tambah Mahasiswa</h2>

  <form action="{{ route('mahasiswa.store') }}" method="POST" class="mb-3">
    @csrf
    @include('mahasiswa._form')
    <div class="mt-3">
      <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
@endsection
