@extends('layouts.guest')

@section('title','Masuk | Kampus-APP')

@section('content')
  <div class="text-center mb-4">
    <h2 class="fw-bold text-white mb-1"><i class="bi bi-mortarboard"></i> Kampus-APP</h2>
    <p class="text-light opacity-75 small mb-0">Masuk untuk melanjutkan ke sistem akademik modern</p>
  </div>

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label text-white-75 fw-semibold">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="form-check">
        <input type="checkbox" id="remember" name="remember" class="form-check-input">
        <label for="remember" class="form-check-label text-white-50 small">Ingat saya</label>
      </div>
<!--       @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="small text-info text-decoration-none">Lupa sandi?</a>
      @endif -->
    </div>

    <button class="btn btn-primary-custom w-100 py-2 shadow-sm" type="submit">
      <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
    </button>

    <div class="text-center mt-3">
      <small class="text-white-50">Belum punya akun?
        <a href="{{ route('register') }}" class="text-info fw-semibold text-decoration-none">Daftar</a>
      </small>
    </div>
  </form>
@endsection
