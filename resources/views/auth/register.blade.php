@extends('layouts.guest')

@section('title','Daftar | Kampus-APP')

@section('content')
  <div class="text-center mb-4">
    <h2 class="fw-bold text-white mb-1"><i class="bi bi-mortarboard"></i> Kampus-APP</h2>
    <p class="text-light opacity-75 small mb-0">Buat akun baru untuk memulai perjalanan akademik</p>
  </div>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label text-white-75 fw-semibold">Nama Lengkap</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required
        class="form-control bg-white text-dark rounded-3 shadow-sm border-0 py-2 px-3"
        placeholder="Masukkan nama lengkap Anda">
      @error('name')
        <small class="text-warning">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label text-white-75 fw-semibold">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required
        class="form-control bg-white text-dark rounded-3 shadow-sm border-0 py-2 px-3"
        placeholder="contoh: user@kampus.ac.id">
      @error('email')
        <small class="text-warning">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label text-white-75 fw-semibold">Kata Sandi</label>
      <input id="password" type="password" name="password" required
        class="form-control bg-white text-dark rounded-3 shadow-sm border-0 py-2 px-3"
        placeholder="Masukkan kata sandi">
      @error('password')
        <small class="text-warning">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-4">
      <label for="password_confirmation" class="form-label text-white-75 fw-semibold">Konfirmasi Kata Sandi</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required
        class="form-control bg-white text-dark rounded-3 shadow-sm border-0 py-2 px-3"
        placeholder="Ulangi kata sandi Anda">
    </div>

    <button class="btn btn-primary-custom w-100 py-2 shadow-sm" type="submit">
      <i class="bi bi-person-plus me-1"></i> Daftar
    </button>

    <div class="text-center mt-3">
      <small class="text-white-50">Sudah punya akun?
        <a href="{{ route('login') }}" class="text-info fw-semibold text-decoration-none">Masuk</a>
      </small>
    </div>
  </form>
@endsection
