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
  @livewireStyles()
</head>
<body>

   @php
                $id_kampus = request()->route('id_kampus');
                $id_prodi = request()->route('id_prodi');
  @endphp

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <div class="d-flex align-items-center mb-4">
      <img src={{ asset("img/logopolije.png") }} alt="Logo" class="logo me-2">
      <span class="fw-semibold small">Politeknik Negeri Jember</span>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href={{ route('admin.dashboard', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }} class="nav-link">
          <img src={{ asset("img/home.svg") }} alt="Beranda" class="icon"> Beranda
        </a>
      </li>
      <li>
        <a href={{ route('admin.kampus', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }} class="nav-link">
          <img src={{ asset("img/Kampus.svg") }} alt="Kampus" class="icon"> Kampus
        </a>
      </li>
      <li>
        <a href={{ route('admin.jurusan', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }} class="nav-link">
          <img src={{ asset("img/topi.svg") }} alt="Jurusan" class="icon"> Jurusan
        </a>
      </li>
      <li>
        <a href={{ route('admin.prodi', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }} class="nav-link">
          <img src={{ asset("img/topi.svg") }} alt="Prodi" class="icon"> Prodi
        </a>
      </li>
      <li>
        <a href="/admin/ds" class="nav-link">
          <img src={{ asset("img/dosentab.svg") }} alt="Dosen" class="icon"> Dosen
        </a>
      </li>
      <li>
        <a href="/admin/m" class="nav-link">
          <img src={{ asset("img/matkul.svg") }} alt="Mata Kuliah" class="icon"> Mata Kuliah
        </a>
      </li> 
      <li>
        <a href={{ route('admin.sesi', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }} class="nav-link">
          <img src={{ asset("img/Sesi.svg") }} alt="Jam" class="icon"> Sesi
        </a>
      </li>
      <li>
        <a href="/admin/jd" class="nav-link">
          <img src={{ asset("img/Jadwal.svg") }} alt="Jadwal" class="icon"> Jadwal
        </a>
      </li>
      <li>
        <a href="/admin/pe" class="nav-link">
          <img src={{ asset("img/akun.svg") }} alt="Pengguna" class="icon"> Pengguna
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
        <img src="{{ asset("img/profile.png") }}" alt="User">
        <button class="logout-btn" onclick="konfirmasiLogout()">
          <img src={{ asset("img/logout.png") }} alt="Logout">
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
        <form action="{{ route('logout.admin', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger">Iya</button>
        </form>
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

@livewireScripts()
</body>
</html>
