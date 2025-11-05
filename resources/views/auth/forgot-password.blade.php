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

    .auth-card {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 24px;
      padding: 3rem 3rem 2.5rem;
      width: 480px;
      backdrop-filter: blur(14px);
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
    }

    h2 {
      font-weight: 700;
      color: #f8fafc;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-label {
      color: #e2e8f0;
      font-weight: 600;
    }

    .form-control {
      background: rgba(255,255,255,0.9);
      border: none;
      border-radius: 12px;
      padding: 0.8rem;
      color: #0f172a;
    }

    .btn-primary-custom {
      background: #38bdf8;
      color: #0f172a;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      padding: 0.8rem;
      width: 100%;
      margin-top: 1rem;
      transition: all 0.25s ease;
    }

    .btn-primary-custom:hover {
      transform: scale(1.03);
      box-shadow: 0 6px 16px rgba(56,189,248,0.4);
    }

    .text-link {
      color: #bae6fd;
      text-decoration: none;
    }

    .text-link:hover {
      text-decoration: underline;
      color: #f0f9ff;
    }

    .alert-success {
      background-color: rgba(34,197,94,0.2);
      border: 1px solid rgba(34,197,94,0.4);
      color: #bbf7d0;
    }

    .alert-danger {
      background-color: rgba(239,68,68,0.2);
      border: 1px solid rgba(239,68,68,0.4);
      color: #fecaca;
    }

  </style>
</head>
<body>

  <div class="auth-card">
    <h2><i class="bi bi-key"></i> Lupa Kata Sandi</h2>

    @if (session('status'))
      <div class="alert alert-success small text-center mb-3">
        {{ session('status') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger small text-center mb-3">
        <ul class="mb-0 list-unstyled">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <p class="text-center text-white-50 mb-4 small">
      Masukkan alamat email Anda dan kami akan mengirimkan tautan<br>untuk mengatur ulang kata sandi Anda.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="contoh: user@kampus.ac.id">
      </div>

      <button type="submit" class="btn btn-primary-custom">
        <i class="bi bi-envelope-paper"></i> Kirim Tautan Reset
      </button>
    </form>

    <div class="text-center mt-3">
      <a href="{{ route('login') }}" class="text-link">
        <i class="bi bi-arrow-left"></i> Kembali ke halaman masuk
      </a>
    </div>
  </div>

</body>
</html>
