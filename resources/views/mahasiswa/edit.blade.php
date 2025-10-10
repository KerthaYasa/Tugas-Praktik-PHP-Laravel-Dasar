@extends('layouts.app')

@section('title','Edit Mahasiswa')

@section('content')
  <h2 class="page-title">Edit Mahasiswa</h2>

  <form action="{{ route('mahasiswa.update', $m->id) }}" method="POST" class="mb-3">
    @csrf
    @method('PUT')
    @include('mahasiswa._form')
    <div class="mt-3">
      <button class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
@endsection
