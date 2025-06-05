@extends('dosen.layout')

@section('dsnsection')

    <!-- Konten utama -->
    <!-- Isi konten untuk halaman Dosen bisa ditambahkan di sini --> 
    <div class="container mt-5">
  <h3 class="mb-4">Presensi Dosen</h3>
  
  <!-- Tombol Presensi -->
  <div class="mb-3">
    <button class="btn btn-primary me-2">Hadir</button>
    <button class="btn btn-outline-primary">Tidak</button>
  </div>
  
  <!-- Tabel Presensi -->
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>Tanggal</th>
          <th>Hari</th>
          <th>Status Presensi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>7/10/2024</td>
          <td>Senin</td>
          <td>Hadir</td>
        </tr>
        <tr>
          <td>8/10/2024</td>
          <td>Selasa</td>
          <td>-</td>
        </tr>
        <tr>
          <td>9/10/2024</td>
          <td>Rabu</td>
          <td>Tidak</td>
        </tr>
        <tr>
          <td>10/10/2024</td>
          <td>Kamis</td>
          <td>-</td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <!-- Pagination -->
  <div class="d-flex justify-content-between align-items-center mt-3">
    <span>Menampilkan 1 sampai 4 dari 4 data</span>
    <nav>
      <ul class="pagination mb-0">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">&lt;</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item">
          <a class="page-link" href="#">&gt;</a>
        </li>
      </ul>
    </nav>
  </div>
</div>


  </div>
</div>

@endsection 