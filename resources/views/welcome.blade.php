<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kampus-APP | Selamat Datang</title>

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
      padding: 3rem 4rem;
      text-align: center;
      backdrop-filter: blur(14px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
      width: 720px;
    }

    h1 {
      font-weight: 700;
      font-size: 3rem;
      color: #f8fafc;
      text-shadow: 0 3px 10px rgba(56,189,248,0.25);
      margin-bottom: 1rem;
    }

    .lead {
      font-size: 1.15rem;
      color: #e2e8f0;
      line-height: 1.5;
      margin-bottom: 2rem;
      width: 95%;
      margin-left: auto;
      margin-right: auto;
      max-width: 600px;
    }

    .btn-custom {
      display: block;
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

    .btn-outline-light {
      border: 1px solid #bae6fd;
      color: #bae6fd;
      margin-top: 1rem;
    }

    .btn-outline-light:hover {
      background-color: #bae6fd;
      color: #0f172a;
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
    <h1><i class="bi bi-mortarboard"></i> Kampus-APP</h1>
    <p class="lead">
      Sistem akademik modern yang elegan dan efisien.<br>
      Dirancang untuk kenyamanan dan kemudahan Anda.
    </p>

    @auth
      <a href="{{ route('dashboard') }}" class="btn btn-custom btn-primary">
        <i class="bi bi-speedometer2 me-1"></i> Buka Dashboard
      </a>
    @else
      <a href="{{ route('login') }}" class="btn btn-custom btn-primary">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
      </a>
      <a href="{{ route('register') }}" class="btn btn-custom btn-outline-light">
        <i class="bi bi-person-plus me-1"></i> Daftar
      </a>
    @endauth
  </div>

  <footer>
    © {{ date('Y') }} Kampus-APP | Dibuat dengan ketenangan & Laravel
  </footer>

</body>
</html>
