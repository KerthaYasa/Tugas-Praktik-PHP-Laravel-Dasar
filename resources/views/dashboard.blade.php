@extends('layouts.app')

@section('content')
<div class="py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-primary mb-1">Dashboard</h2>
      <p class="text-muted mb-0">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>
    @auth
      <div class="text-muted small bg-light px-3 py-2 rounded-3 shadow-sm">
        <i class="bi bi-person-circle me-1 text-primary"></i>
        {{ auth()->user()->name }} — <span class="text-capitalize">{{ auth()->user()->role }}</span>
      </div>
    @endauth
  </div>

  <div class="row g-4 mb-5">
    {{-- === Kartu Mahasiswa === --}}
    <div class="col-md-4">
      <div class="card p-4 text-center border-0 shadow-sm hover-shadow transition h-100">
        <div class="text-primary mb-2"><i class="bi bi-people-fill fs-3"></i></div>
        <small class="text-muted">Total Mahasiswa</small>
        <h3 class="fw-bold mt-2 text-dark">{{ $totalMahasiswa }}</h3>
        <a href="{{ url('mahasiswa') }}" class="small text-primary fw-semibold text-decoration-none">
          Lihat data →
        </a>
      </div>
    </div>

    {{-- === Kartu Program Studi === --}}
    <div class="col-md-4">
      <div class="card p-4 text-center border-0 shadow-sm hover-shadow transition h-100">
        <div class="text-success mb-2"><i class="bi bi-journal-text fs-3"></i></div>
        <small class="text-muted">Program Studi</small>
        <h3 class="fw-bold mt-2 text-dark">{{ $totalProdi }}</h3>
        <a href="{{ url('prodi') }}" class="small text-success fw-semibold text-decoration-none">
          Lihat data →
        </a>
      </div>
    </div>

    {{-- === Kartu Fakultas === --}}
    <div class="col-md-4">
      <div class="card p-4 text-center border-0 shadow-sm hover-shadow transition h-100">
        <div class="text-warning mb-2"><i class="bi bi-building fs-3"></i></div>
        <small class="text-muted">Fakultas</small>
        <h3 class="fw-bold mt-2 text-dark">{{ $totalFakultas }}</h3>
        <a href="{{ url('fakultas') }}" class="small text-warning fw-semibold text-decoration-none">
          Lihat data →
        </a>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm p-4 bg-white rounded-4">
    <h5 class="fw-bold text-primary mb-3">Informasi Aplikasi</h5>
    <p class="text-muted mb-0">
      Kampus-APP merupakan sistem sederhana berbasis Laravel yang digunakan untuk mengelola data mahasiswa,
      program studi, dan fakultas. Tampilan dashboard ini didesain dengan warna putih dominan agar terlihat bersih dan profesional.
    </p>
  </div>
</div>

<style>
  .hover-shadow:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
  }
  .transition {
    transition: all 0.3s ease;
  }
  a.text-decoration-none, a.text-decoration-none:hover {
    color: inherit !important;
  }
</style>
@endsection
