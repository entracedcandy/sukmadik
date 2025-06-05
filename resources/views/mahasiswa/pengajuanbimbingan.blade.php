 @extends('mahasiswa.layout')

@section('mhssection')

<div class="container mt-5">
    <h3 class="mb-4">Pengajuan Jadwal Bimbingan</h3>
    <form>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
        </div>
        <div class="mb-3">
            <label for="kampus" class="form-label">Kampus</label>
            {{-- Menampilkan nama kampus dari objek $kampus yang diterima --}}
            <input type="text" class="form-control" id="kampus" value="{{ $kampus->nama_kampus ?? '' }}" readonly>
            {{-- Menyimpan ID kampus sebagai hidden input jika diperlukan saat submit form --}}
            <input type="hidden" name="id_kampus" value="{{ $kampus->id_kampus ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <select class="form-select" id="jurusan" name="id_jurusan">
                <option selected disabled>Pilih Jurusan</option>
                {{-- Melakukan loop untuk mengisi opsi Jurusan --}}
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id_jurusan }}"
                        {{ (isset($id_jurusan) && $jurusan->id_jurusan == $id_jurusan) ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi</label>
            <select class="form-select" id="prodi" name="id_prodi">
                <option selected disabled>Pilih Prodi</option>
                {{-- Melakukan loop untuk mengisi opsi Prodi --}}
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->id_prodi }}"
                        {{ (isset($id_prodi) && $prodi->id_prodi == $id_prodi) ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dosen" class="form-label">Dosen</label>
            <select class="form-select" id="dosen" name="id_dosen">
                <option selected disabled>Pilih Dosen</option>
                {{-- Melakukan loop untuk mengisi opsi Dosen dari data $usersDosen --}}
                @foreach($usersDosen as $userDosen)
                    <option value="{{ $userDosen->id_user }}">{{ $userDosen->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <select class="form-select" id="semester" name="id_semester">
                <option selected disabled>Pilih Semester</option>
                {{-- Melakukan loop untuk mengisi opsi Semester dari data $semesters --}}
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id_semester }}">{{ $semester->nama_semester }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
        </div>
        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" placeholder="Tulis Keperluan"></textarea>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">cari sesi</button>
        </div>
    </form>
</div>

@endsection