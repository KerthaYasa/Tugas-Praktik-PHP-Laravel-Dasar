@extends('layouts.app')

@section('title', 'Detail Fakultas')

@section('content')
<div class="card shadow border-0 rounded-3">
  <div class="card-header bg-primary text-white d-flex align-items-center">
    <i class="bi bi-building fs-4 me-2"></i>
    <h5 class="mb-0">Detail Fakultas</h5>
  </div>

  <div class="card-body">
    <table class="table table-borderless mb-4">
      <tr><th style="width: 180px;">Kode Fakultas</th><td>{{ $fakultas->kode_fakultas }}</td></tr>
      <tr><th>Nama Fakultas</th><td>{{ $fakultas->nama_fakultas }}</td></tr>
      <tr><th>Dibuat Pada</th><td>{{ optional($fakultas->created_at)->format('d M Y, H:i') ?? '-' }}</td></tr>
      <tr><th>Terakhir Diperbarui</th><td>{{ optional($fakultas->updated_at)->format('d M Y, H:i') ?? '-' }}</td></tr>
    </table>

    <div class="d-flex justify-content-end gap-2">
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('fakultas.edit', $fakultas->id) }}" class="btn btn-primary">
          <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
      @endif
      <a href="{{ route('fakultas.index') }}" class="btn btn-light border">
        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
      </a>
    </div>
  </div>
</div>
@endsection
