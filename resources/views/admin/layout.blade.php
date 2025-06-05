<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sidebar Polije</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #ffffff;
      border-right: 1px solid #dee2e6;
    }

    .sidebar .nav-link {
      color: #333;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 0;
    }

    .sidebar .nav-link:hover {
      background-color: #f8f9fa;
    }

    .sidebar img.logo {
      width: 60px;
      height: 60px;
      object-fit: contain;
      border-radius: 0; /* Hapus frame/bulat */
    }

    .sidebar img.icon {
      width: 20px;
      height: 20px;
    }

    .sidebar .branding {
      margin-bottom: 30px; /* Jarak logo ke daftar menu */
    }

    .sidebar ul.nav > li + li {
      margin-top: 5px; /* Jarak antar item menu */
    }

    .navbar-top {
      height: 60px;
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 0 40px;
    }

    .navbar-top .user-info {
      display: flex;
      align-items: center;
      gap: 16px;
      font-size: 1rem;
      font-weight: 500;
    }

    .navbar-top .user-info span {
      margin-right: 8px;
    }

    .navbar-top .user-info img {
      width: 26px;
      height: 26px;
      object-fit: contain;
    }

    .navbar-top .logout-btn img {
      width: 24px;
      height: 24px;
      transition: 0.3s ease;
    }

    .navbar-top .logout-btn img:hover {
      transform: scale(1.1);
    }

    .navbar-top .logout-btn {
      background: none;
      border: none;
      padding: 0;
    }

  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <div class="d-flex align-items-center mb-4">
      <img src="../img/logopolije.png" alt="Logo" class="logo me-2">
      <span class="fw-semibold small">Politeknik Negeri Jember</span>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/admin/d" class="nav-link">
          <img src="../img/home.svg" alt="Beranda" class="icon"> Beranda
        </a>
      </li>
      <li>
        <a href="/admin/ds" class="nav-link">
          <img src="../img/dosentab.svg" alt="Dosen" class="icon"> Dosen
        </a>
      </li>
      <li>
        <a href="/admin/k" class="nav-link">
          <img src="../img/kampus.svg" alt="Kampus" class="icon"> Kampus
        </a>
      </li>
      <li>
        <a href="/admin/ju" class="nav-link">
          <img src="../img/topi.svg" alt="Jurusan" class="icon"> Jurusan
        </a>
      </li>
      <li>
        <a href="/admin/pr" class="nav-link">
          <img src="../img/topi.svg" alt="Prodi" class="icon"> Prodi
        </a>
      </li>
      <li>
        <a href="/admin/m" class="nav-link">
          <img src="../img/matkul.svg" alt="Mata Kuliah" class="icon"> Mata Kuliah
        </a>
      </li>
      <li>
        <a href="/admin/jm" class="nav-link">
          <img src="../img/sesi.svg" alt="Jam" class="icon"> Jam
        </a>
      </li>
      <li>
        <a href="/admin/jd" class="nav-link">
          <img src="../img/jadwal.svg" alt="Jadwal" class="icon"> Jadwal
        </a>
      </li>
      <li>
        <a href="/admin/pe" class="nav-link">
          <img src="../img/akun.svg" alt="Pengguna" class="icon"> Pengguna
        </a>
      </li>
    </ul>
  </div>

  <!-- Main content -->
  <div class="flex-grow-1 p-3">
    <!-- Navbar Top -->
    <div class="navbar-top">
      <div class="user-info">
        <span id="nama-user">Admin</span>
        <img src="../img/profile.png" alt="User">
        <button class="logout-btn" onclick="konfirmasiLogout()">
          <img src="../img/logout.png" alt="Logout">
        </button>
      </div>
    </div>

    @yield('adminsection')
  </div>
</div>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLogoutLabel">Konfirmasi</h5>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a href="/admin" class="btn btn-danger">Iya</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function konfirmasiLogout() {
    var myModal = new bootstrap.Modal(document.getElementById('modalLogout'));
    myModal.show();
  }

  // Ganti nama user sesuai session
  document.getElementById('nama-user').textContent = "<?php echo $_SESSION['nama_user'] ?? 'Admin'; ?>";
</script>

</body>
</html>
