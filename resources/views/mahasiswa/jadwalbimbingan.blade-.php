@extends('mahasiswa.layout')

@section('mhssection')

<style>
    /* Styling dasar untuk jadwal */
    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .schedule-table th,
    .schedule-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
        vertical-align: top; /* Agar konten mulai dari atas */
    }
    .schedule-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .schedule-table td.time-slot {
        width: 100px; /* Lebar kolom waktu */
        background-color: #e9ecef; /* Warna abu-abu untuk slot waktu */
        font-weight: bold;
    }
    .schedule-cell {
        background-color: #ffffff; /* Default background untuk sel kosong */
    }
    /* Contoh warna untuk kegiatan (sesuaikan dengan kebutuhan Anda) */
    .activity-yellow {
        background-color: #fff3cd; /* Warna kuning */
        border: 1px solid #ffeeba;
    }
    .activity-green {
        background-color: #d4edda; /* Warna hijau */
        border: 1px solid #c3e6cb;
    }
    .activity-blue {
        background-color: #d1ecf1; /* Warna biru */
        border: 1px solid #bee5eb;
    }
    .activity-red {
        background-color: #f8d7da; /* Warna merah */
        border: 1px solid #f5c6cb;
    }
    .activity-grey {
        background-color: #e2e3e5; /* Warna abu-abu gelap untuk istirahat/lain-lain */
        border: 1px solid #d6d8db;
    }
    .activity-content {
        font-size: 0.9em;
    }
    .activity-content strong {
        display: block;
        margin-bottom: 3px;
    }
    .activity-content small {
        display: block;
        font-style: italic;
        color: #555;
    }
    .day-header {
        background-color: #f8f9fa; /* Warna latar belakang untuk header hari */
        font-size: 1.2em;
        font-weight: bold;
        text-align: left;
        padding: 10px;
        border-bottom: 2px solid #dee2e6;
    }
</style>

<div class="container">
    <h1>Daftar Jadwal Bimbingan</h1>

    {{-- Filter Section --}}
    <form action="{{ route('mahasiswa.jadwal', ['id' => $id]) }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dosen_id">Filter Dosen:</label>
                    <select name="dosen_id" id="dosen_id" class="form-control">
                        <option value="">-- Pilih Dosen (Semua Dosen) --</option> {{-- Ubah teks --}}
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id_user }}" {{ request('dosen_id') == $dosen->id_user ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="semester">Filter Semester:</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="">-- Pilih Semester (Semua Semester) --</option> {{-- Ubah teks --}}
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id_semester }}" {{ request('semester') == $semester->id_semester ? 'selected' : '' }}>
                                {{ $semester->ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('mahasiswa.jadwal', ['id' => $id]) }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
    <hr>

    {{-- Pesan Peringatan --}}
    {{-- Hapus bagian ini jika warningMessage hanya untuk "pilih dosen dan semester" --}}
    {{-- @if($warningMessage)
        <div class="alert alert-warning" role="alert">
            {{ $warningMessage }}
        </div>
    @endif --}}

    {{-- Menampilkan Jadwal dalam format tabel --}}
    @if($jadwals->isNotEmpty())
        @foreach($jadwals as $hari => $jadwalHari)
            <div class="day-header mt-4 mb-2">{{ $hari }}</div>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th class="time-slot" style="width:120px;">Waktu</th>
                        <th>Kegiatan / Topik Bimbingan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                        @php
                            $hasActivityInSlot = false;
                            $activityDisplayed = false;
                        @endphp
                        <tr>
                            <td class="time-slot">{{ $jadwal[0]->hari }}</td>
                            @foreach($jadwal[0]->sesi as $index => $sesi)
                                @php
                                    $eventStart = \Carbon\Carbon::parse($sesi['start']);
                                    $eventEnd = \Carbon\Carbon::parse($sesi['end']);
                                    // $isStartingNow = $eventStart->equalTo($slotStart);
                                @endphp

                                {{-- @if($isStartingNow && !$activityDisplayed) --}}

                                    {{-- <td rowspan="{{ $rowspan }}" class="{{ $colorClass }} activity-cell"> --}}
                                    <td rowspan="" class="activity-cell">
                                        <div class="activity-content">
                                            {{-- <strong>{{ $sesi-> }}</strong> --}}
                                            {{-- <small>{{ $sesi-> }}</small> --}}
                                        </div>
                                    </td>
                                    {{-- @break
                                @endif --}}
                            @endforeach

                            @if (!$hasActivityInSlot)
                                <td class="activity-cell"></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @elseif(!$warningMessage)
        <p>Tidak ada jadwal yang tersedia untuk kriteria yang dipilih.</p>
    @endif

</div>

@endsection