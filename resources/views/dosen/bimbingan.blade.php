@extends('dosen.layout')

@section('dsnsection')
    <!-- Konten utama -->
    <!-- Isi konten untuk halaman Dosen bisa ditambahkan di sini -->

    <div class="container mt-5">
  <h4 class="mb-4 fw-bold">Approval Bimbingan</h4>
  <div class="table-responsive shadow rounded border">
    <table class="table align-middle">
      <thead class="bg-light">
        <tr class="text-center">
          <th scope="col" class="py-3">Tanggal</th>
          <th scope="col">Hari</th>
          <th scope="col">Jam</th>
          <th scope="col">Mahasiswa</th>
          <th scope="col">Keperluan</th>
          <th scope="col">Status Approval</th>
          <th scope="col">Approval</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-center">
          <td class="py-3">7/10/2024</td>
          <td>Senin</td>
          <td>13.00-14.00</td>
          <td>Dita</td>
          <td>TA</td>
          <td><span class="badge bg-success">Ya</span></td>
          <td>
            <button class="btn btn-outline-primary btn-sm px-3">Ya</button>
            <button class="btn btn-outline-danger btn-sm px-3">Tidak</button>
          </td>
        </tr>
        <tr class="text-center">
          <td class="py-3">8/10/2024</td>
          <td>Selasa</td>
          <td>14.00-15.00</td>
          <td>Vemas</td>
          <td>TA</td>
          <td><span class="badge bg-danger">Tidak</span></td>
          <td>
            <button class="btn btn-outline-primary btn-sm px-3">Ya</button>
            <button class="btn btn-outline-danger btn-sm px-3">Tidak</button>
          </td>
        </tr>
        <tr class="text-center">
          <td class="py-3">8/10/2024</td>
          <td>Selasa</td>
          <td>16.00-17.00</td>
          <td>Muklis</td>
          <td>PBL</td>
          <td><span class="badge bg-secondary">-</span></td>
          <td>
            <button class="btn btn-outline-primary btn-sm px-3">Ya</button>
            <button class="btn btn-outline-danger btn-sm px-3">Tidak</button>
          </td>
        </tr>
        <tr class="text-center">
          <td class="py-3">10/10/2024</td>
          <td>Kamis</td>
          <td>10.00-11.00</td>
          <td>Dimas</td>
          <td>PBL</td>
          <td><span class="badge bg-secondary">-</span></td>
          <td>
            <button class="btn btn-outline-primary btn-sm px-3">Ya</button>
            <button class="btn btn-outline-danger btn-sm px-3">Tidak</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-4">
    <span class="text-muted">Menampilkan 1 sampai 4 dari 4 data</span>
    <nav aria-label="Page navigation">
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item"><a class="page-link" href="#">&lt;</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
      </ul>
    </nav>
  </div>
</div>
    
  </div>
</div>

@endsection