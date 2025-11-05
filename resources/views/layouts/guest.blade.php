<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Kampus-APP')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    html,body { height:100%; }
    body {
      margin:0;
      font-family:'Poppins',sans-serif;
      background: linear-gradient(135deg, #1e3a8a, #2563eb, #38bdf8);
      color:#f8fafc;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }

    .auth-wrapper {
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding: 2rem;
    }

    .auth-card {
      width: 480px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.14);
      border-radius: 18px;
      padding: 2.5rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.35);
      backdrop-filter: blur(10px);
    }

    .form-control.bg-transparent {
      background: transparent !important;
      color: #fff !important;
      border: 1px solid rgba(255,255,255,0.2);
    }
    .form-label { color: #e6f2ff; font-weight:600; }

    .btn-primary-custom {
      background: #38bdf8;
      color: #0f172a;
      border-radius: 12px;
      font-weight:600;
    }

    /* responsive */
    @media (max-width:575px) {
      .auth-card { width: 100%; padding: 1.5rem; border-radius: 12px; }
    }
  </style>

  @stack('head')
</head>
<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
