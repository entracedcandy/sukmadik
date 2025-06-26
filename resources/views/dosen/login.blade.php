@extends('dashboard.layout')

@section('dashboardsection')

@php
    $id_kampus = request()->route('id_kampus');
    $id_prodi = request()->route('id_prodi');
@endphp

<div class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #4A90E2;">
    <div class="bg-white p-5 rounded-4 shadow text-center" style="max-width: 400px; width: 100%;">
        <h2 class="mb-3">Login Dosen</h2>
        <p class="text-muted mb-4">Silahkan masukkan email dan password Anda</p>

        {{-- Menampilkan error dari auth jika login gagal --}}
        @if (session('status'))
            <div class="alert alert-success mb-3">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="text-start">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Form login yang diarahkan ke Breeze --}}
        <form method="POST" action="{{ route('login.dosen', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3 text-start">
                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            </div>

            {{-- Password --}}
            <div class="mb-4 text-start">
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" id="passwordInput" required>
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            {{-- Tombol login --}}
            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Login</button>
        </form>
    </div>
</div>

{{-- Script untuk toggle password --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');

        toggle.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    });
</script>

@endsection
