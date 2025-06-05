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
    <form action="{{ route('mahasiswa.jadwal', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dosen_id">Filter Dosen:</label>
                    <select name="dosen_id" id="dosen_id" class="form-control">
                        <option value=""> Pilih Dosen </option> {{-- Ubah teks --}}
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
                <a href="{{ route('mahasiswa.jadwal', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]) }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
    <hr>

    {{-- @php
        DD($jadwals);
    @endphp --}}

    {{-- Pesan Peringatan --}}
    {{-- Hapus bagian ini jika warningMessage hanya untuk "pilih dosen dan semester" --}}
    {{-- @if($warningMessage)
        <div class="alert alert-warning" role="alert">
            {{ $warningMessage }}
        </div>
    @endif --}}

    {{-- Menampilkan Jadwal dalam format tabel --}}
    @if($jadwals->isNotEmpty())
        @php
            // Fungsi helper untuk menentukan warna berdasarkan nama_jadwal
            function getActivityColorClass($activityName) {
                $activityName = strtolower($activityName);
                if (str_contains($activityName,'12.00 - 13.00' )) {
                    return 'activity-red';
                // } elseif (str_contains($activityName, 'mobile application')) {
                //     return 'activity-green';
                // } elseif (str_contains($activityName, 'tata kelola') || str_contains($activityName, 'developer operational')) {
                //     return 'activity-blue';
                // } elseif (str_contains($activityName, '17.00 - 18.00')) { // Contoh untuk waktu tertentu
                //     return 'activity-red';
                // } elseif (str_contains($activityName, '12.00 - 13.00')) { // Contoh untuk waktu tertentu
                //     return 'activity-grey';
                }
                return 'activity-cell'; // Default
            }
        @endphp

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
                    @php
                    // DD($jadwalHari);
                        $eventsToday = []; // Untuk menyimpan event yang sudah diproses agar bisa menangani rowspan
                        foreach ($jadwalHari as $jadwalItem) {
                            foreach ($jadwalItem->sesi as $sesiItem) {
                                $sesiStart = Carbon\Carbon::parse($sesiItem->start);
                                $sesiEnd = Carbon\Carbon::parse($sesiItem->end);
                                foreach ($sesiItem->detail_sesi as $detailSesiItem) {
                                    $activityName = $detailSesiItem->matkul->nama_matkul ?? $detailSesiItem->pengajuan_bimbingan->nama_pengajuan ?? 'N/A';
                                    $lecturerName = $detailSesiItem->matkul->user->nama ?? $detailSesiItem->pengajuan_bimbingan->user->nama ?? 'N/A';
                                    // Hitung durasi sesi dalam jam untuk rowspan (asumsi slot per jam)
                                    $durationHours = $sesiEnd->diffInMinutes($sesiStart) / 60;
                                    // dump(isset($detailSesiItem->matkul->id_user));
        
                                    $eventsToday[] = [
                                        'start_time' => $sesiStart->format('H:i'),
                                        'end_time' => $sesiEnd->format('H:i'),
                                        'activity_name' => isset($detailSesiItem->matkul->id_user) && $detailSesiItem->matkul->id_user == $dosenId? $activityName : '',
                                        'lecturer_name' => isset($detailSesiItem->matkul->id_user) && $detailSesiItem->matkul->id_user == $dosenId? $lecturerName : '',
                                        'rowspan' => $durationHours, // Akan dihitung ulang jika slot waktu berbeda
                                        'detailSesi' => $detailSesiItem, // Simpan objek untuk akses data penuh
                                        
                                    ];
                                }
                            }
                        }
                        // Sort events by start time
                        usort($eventsToday, function($a, $b) {
                            return strtotime($a['start_time']) - strtotime($b['start_time']);
                        });
                        $currentEvents = []; // Untuk melacak event yang sedang aktif di slot waktu
                    @endphp

                    @foreach($timeSlots as $slot)
                        @php
                            $slotStart = Carbon\Carbon::parse(explode(' - ', $slot)[0]);
                            $slotEnd = Carbon\Carbon::parse(explode(' - ', $slot)[1]);
                            $hasActivityInSlot = false;
                            $activityDisplayed = false;
                        @endphp
                        <tr>
                            <td class="time-slot">{{ $slot }}</td>
                            @foreach($eventsToday as $eventKey => $event)
                                @php
                                    $eventStart = \Carbon\Carbon::parse($event['start_time']);
                                    $eventEnd = \Carbon\Carbon::parse($event['end_time']);
                                    $isStartingNow = $eventStart->equalTo($slotStart);
                                @endphp

                                @if($isStartingNow && !$activityDisplayed)
                                    @php  
                                        $rowspan = $eventEnd->diffInMinutes($eventStart) / $slotEnd->diffInMinutes($slotStart);
                                        $rowspan = max((int) $rowspan, 1);

                                        $colorClass = getActivityColorClass($event['activity_name']);
                                        $activityDisplayed = true;
                                        $hasActivityInSlot = true;

                                        unset($eventsToday[$eventKey]); // Prevent duplicate rendering
                                    @endphp

                                    <td rowspan="{{ $rowspan }}" class="{{ $colorClass }} activity-cell">
                                        <div class="activity-content">
                                            <strong>{{ $event['activity_name'] }}</strong>
                                            <small>{{ $event['lecturer_name'] }}</small>
                                        </div>
                                    </td>
                                    @break
                                @endif
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