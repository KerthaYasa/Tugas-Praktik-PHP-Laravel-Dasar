@extends('layouts.app')

@section('title', 'Detail Fakultas')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h3 class="page-title mb-3"><i class="bi bi-info-circle"></i> Detail Fakultas</h3>

    <table class="table table-bordered align-middle">
      <tr>
        <th width="25%">Nama Fakultas</th>
        <td>{{ $fakultas->nama_fakultas }}</td>
      </tr>
      <tr>
        <th>Dekan</th>
        <td>{{ $fakultas->dekan ?? '-' }}</td>
      </tr>
      <tr>
        <th>Jumlah Prodi</th>
        <td>{{ $fakultas->prodi->count() }}</td>
      </tr>
      <tr>
        <th>Dibuat pada</th>
        <td>{{ optional($fakultas->created_at)->format('d M Y H:i') ?? '-' }}</td>
      </tr>
      <tr>
        <th>Terakhir diperbarui</th>
        <td>{{ optional($fakultas->updated_at)->format('d M Y H:i') ?? '-' }}</td>
      </tr>
    </table>

    <div class="d-flex justify-content-end gap-2 mt-4">
      <a href="{{ route('fakultas.edit', $fakultas->id) }}" class="btn btn-success">
        <i class="bi bi-pencil"></i> Edit
      </a>
    <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</div>
@endsection
