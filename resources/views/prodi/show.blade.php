@extends('layouts.app')

@section('title', 'Detail Prodi')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h3 class="page-title mb-3"><i class="bi bi-info-circle"></i> Detail Program Studi</h3>

    <table class="table table-bordered align-middle">
      <tr>
        <th width="25%">Nama Prodi</th>
        <td>{{ $p->nama_prodi }}</td>
      </tr>
      <tr>
        <th>Kaprodi</th>
        <td>{{ $p->kaprodi }}</td>
      </tr>
      <tr>
        <th>Jumlah Mahasiswa</th>
        <td>{{ $p->mahasiswa_count ?? 0 }}</td>
      </tr>
      <tr>
        <th>Fakultas</th>
        <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
      </tr>
      <tr>
        <th>Dibuat pada</th>
        <td>{{ $p->created_at->format('d M Y H:i') }}</td>
      </tr>
      <tr>
        <th>Terakhir diperbarui</th>
        <td>{{ $p->updated_at->format('d M Y H:i') }}</td>
      </tr>
    </table>

    <div class="mt-3 d-flex justify-content-between">
      <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
      <a href="{{ route('prodi.edit', $p->id) }}" class="btn btn-success">
        <i class="bi bi-pencil"></i> Edit
      </a>
    </div>
  </div>
</div>
@endsection