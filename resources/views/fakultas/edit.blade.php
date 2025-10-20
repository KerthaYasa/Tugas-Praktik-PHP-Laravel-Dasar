@extends('layouts.app')

@section('title', 'Edit Fakultas')

@section('content')
<div class="card">
  <div class="card-body">
    <h2 class="page-title mb-3">Edit Data Fakultas</h2>

    <form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
      @csrf
      @method('PUT')
      @include('fakultas._form')

      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-check-circle"></i> Update
        </button>
        <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</div>
@endsection