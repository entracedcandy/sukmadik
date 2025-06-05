@extends('dashboard.layout')

@section('dashboardsection')
<div class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #4A90E2;">
  <div class="bg-white p-5 rounded-4 shadow text-center" style="max-width: 400px; width: 100%;">
    <h2 class="mb-3">Login Admin</h2>
    <p class="text-muted mb-4">Silahkan masukkan username dan password</p>

    <form method="POST" action="/admin/d">
      @csrf
      <div class="mb-3 text-start">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-4 text-start">
        <div class="input-group">
          <input type="password" name="password" class="form-control" placeholder="Password" id="passwordInput" required>
      
            <i class="bi bi-eye" id="eyeIcon"></i>
          </span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Login</button>
    </form>
  </div>
</div>

{{-- Script untuk toggle show/hide password --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');

    toggle.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Ganti ikon
      eyeIcon.classList.toggle('bi-eye');
      eyeIcon.classList.toggle('bi-eye-slash');
    });
  });
</script>
@endsection
