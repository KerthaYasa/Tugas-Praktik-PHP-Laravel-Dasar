@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Profil Pengguna</h2>
  <p>Nama: {{ auth()->user()->name }}</p>
  <p>Email: {{ auth()->user()->email }}</p>
</div>
@endsection
