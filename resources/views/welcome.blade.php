<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi | Kampus-APP</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      color: #f8fafc;
      margin: 0;
      background: linear-gradient(135deg, #1e3a8a, #2563eb, #38bdf8);
      background-attachment: fixed;
    }

    .card {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 30px;
      padding: 3rem 3rem 2rem 3rem;
      text-align: center;
      backdrop-filter: blur(14px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
      width: 480px;
    }

    h1 {
      font-weight: 700;
      font-size: 2.2rem;
      color: #f8fafc;
      margin-bottom: 1rem;
      text-shadow: 0 3px 10px rgba(56,189,248,0.25);
    }

    p {
      color: #e2e8f0;
      font-size: 1rem;
      margin-bottom: 2rem;
    }

    .form-control {
      border-radius: 14px;
      padding: 0.8rem 1rem;
      border: 1px solid #bae6fd;
      background: rgba(255, 255, 255, 0.15);
      color: #f8fafc;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 0 0 0.2rem rgba(56,189,248,0.4);
      border-color: #38bdf8;
    }

    .btn-custom {
      width: 100%;
      border-radius: 16px;
      font-weight: 600;
      font-size: 1.05rem;
      padding: 0.9rem 0;
      transition: all 0.25s ease;
    }

    .btn-custom:hover {
      transform: scale(1.03);
      box-shadow: 0 6px 18px rgba(56,189,248,0.35);
    }

    .btn-primary {
      background-color: #38bdf8;
      border: none;
      color: #0f172a;
    }

    .link-light {
      color: #bae6fd;
      display: inline-block;
      margin-top: 1.5rem;
      font-size: 0.95rem;
    }

    .link-light:hover {
      text-decoration: underline;
      color: #fff;
    }

    .alert {
      border-radius: 12px;
      margin-bottom: 1rem;
    }

    footer {
      position: absolute;
      bottom: 18px;
      font-size: 0.9rem;
      color: #cbd5e1;
      text-align: center;
      width: 100%;
    }
  </style>
</head>
<body>

  <div class="card">
    <h1><i class="bi bi-lock"></i> Lupa Kata Sandi</h1>
    <p>Masukkan alamat email Anda, kami akan mengirimkan tautan untuk mereset kata sandi.</p>

    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3 text-start">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="nama@kampus.ac.id" required autofocus>
        @error('email')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-custom btn-primary">
        <i class="bi bi-envelope-paper me-1"></i> Kirim Tautan Reset
      </button>
    </form>

    <a href="{{ route('login') }}" class="link-light">
      <i class="bi bi-arrow-left"></i> Kembali ke Halaman Login
    </a>
  </div>

  <footer>
    © {{ date('Y') }} Kampus-APP | Semua hak dilindungi
  </footer>

</body>
</html>
