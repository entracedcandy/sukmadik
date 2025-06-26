@extends('mahasiswa.layout')

@section('mhssection')
{{-- <form action="{{ route('mahasiswa.pengajuanbimbingan', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }}" method="POST">
    @csrf

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <!-- Nama -->
    <div class="mb-3">
        <label class="form-label">Nama:</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <!-- NIM -->
    <div class="mb-3">
        <label class="form-label">NIM:</label>
        <input type="text" name="nim" class="form-control" required>
    </div>

    <!-- Tujuan -->
    <div class="mb-3">
        <label class="form-label">Tujuan:</label>
        <input type="text" name="tujuan" class="form-control" required>
    </div>

    <!-- Catatan -->
    <div class="mb-3">
        <label class="form-label">Catatan:</label>
        <textarea name="catatan" class="form-control"></textarea>
    </div>

    <!-- Tanggal -->
    <div class="mb-3">
        <label class="form-label">Tanggal:</label>
        <input wire:model="SelectedTanggal" type="date" name="tanggal" class="form-control" required>
    </div>

    <!-- ID User -->
    <div class="mb-3">
        <label class="form-label">Dosen:</label>
        <select wire:model="SelectedDosen" name="id_user" class="form-select" required>
            <option value="">-- Pilih Dosen --</option>
        @foreach ($prodi as $item)
            @foreach ($item->userDosen as $user)
                <option value="{{ $user->id_user }}">{{ $user->nama }}</option>
            @endforeach
        @endforeach
        </select>
    </div>

    <!-- ID Kampus -->
    <div class="mb-3">
        <label class="form-label">Kampus:</label>
        <select name="id_kampus" class="form-select" required>
            <option value="">-- Pilih Kampus --</option>
            @foreach ($kampus as $item)
                <option value="{{ $item->id_kampus }}" {{ $item->id_kampus == $id_kampus ? 'selected' : '' }}>
                    {{ $item->nama_kampus }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- ID Jurusan -->
    <div class="mb-3">
        <label class="form-label">Jurusan:</label>
        <select name="id_jurusan" class="form-select" required>
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusan as $item) 
                <option value="{{ $item->id_jurusan }}">{{ $item->nama_jurusan }}</option>
            @endforeach
        </select>
    </div>

    <!-- ID Prodi -->
    <div class="mb-3">
        <label class="form-label">Program Studi:</label>
        <select name="id_prodi" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            @foreach ($prodi as $item)
                <option value="{{ $item->id_prodi }}" {{ $item->id_prodi == $id_prodi ? 'selected' : '' }}>
                    {{ $item->nama_prodi }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- ID Golongan -->
    <div class="mb-3">
        <label class="form-label">Golongan:</label>
        <select wire:model="SelectedGolongan" name="id_golongan" class="form-select" required>
            <option value="">-- Pilih Golongan --</option>
            @foreach ($golongan as $item)
                <option value="{{ $item->id_golongan }}">{{ $item->nama_golongan }}</option>
            @endforeach
        </select>
    </div>

    <!-- ID Semester -->
    <div class="mb-3">
        <label class="form-label">Semester:</label>
        <select wire:model="SelectedSemester" name="id_semester" class="form-select" required>
            <option value="">-- Pilih Semester --</option>
            @foreach ($semester as $item)
                <option value="{{ $item->id_semester }}">{{ $item->nama_semester }}</option>
            @endforeach
        </select>
    </div>



    {{-- <!-- ID Sesi -->
    <div class="mb-3">
        <label class="form-label">ID Sesi:</label>
        <input type="number" name="id_sesi" class="form-control" required>
    </div>

    <!-- ID Jadwal -->
    <div class="mb-3">
        <label class="form-label">ID Jadwal:</label>
        <input type="number" name="id_jadwal" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
</form> --}}

@livewire('cari-sesi', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])
@endsection
