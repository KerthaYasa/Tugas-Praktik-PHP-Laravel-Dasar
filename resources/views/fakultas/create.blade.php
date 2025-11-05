@extends('layouts.app')

@section('title', 'Tambah Fakultas')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Fakultas</h5>
      <div></div>
    </div>

    <div class="card-body">
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form action="{{ route('fakultas.store') }}" method="POST">
        @csrf

        {{-- include partial form (fields) --}}
        @include('fakultas._form')

        {{-- tombol Simpan lalu Kembali (di kanan) --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="{{ route('fakultas.index') }}" class="btn btn-light px-4">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
