@extends('layouts.app')

@section('title','Tambah Program Studi')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
      <div class="me-3">
        <i class="bi bi-journal-code fs-3"></i>
      </div>
      <div>
        <h3 class="mb-0">Tambah Program Studi</h3>
        <small class="text-muted">Masukkan nama prodi, kaprodi, dan pilih fakultas</small>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Periksa input anda:</strong>
        <ul class="mb-0">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('prodi.store') }}" method="POST">
      @csrf

      @include('prodi._form')

      <div class="d-flex justify-content-end mt-4">
 
        <div>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Simpan
          </button>
          <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
