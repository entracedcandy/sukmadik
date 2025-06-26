@extends('dashboard.layout')

@section('dashboardsection')

    @if($kampus)
        <h1>Selamat datang di {{ $kampus->nama_kampus }}</h1>
        {{-- Anda bisa menampilkan detail kampus lainnya di sini --}}
        <p>Alamat: {{ $kampus->alamat }}</p>
        {{-- dll --}}
    @else
        {{-- Kondisi ini seharusnya jarang terjadi jika validasi di controller bekerja --}}
        <h1>Silakan pilih kampus terlebih dahulu atau terjadi kesalahan.</h1>
    @endif

     @php
    $id_kampus = request()->route('id_kampus');
    $id_prodi = request()->route('id_prodi');

    $hariMap = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu'
    ];

    $hariOrder = [1, 2, 3, 4, 5, 6, 7];
    $jadwals = collect();

    // Gabungkan semua detail_jadwal dari seluruh dosen
    foreach ($query as $user) {
        foreach ($user->detail_jadwal as $item) {
            $jadwals->push($item);
        }
    }

    // Kelompokkan berdasarkan id_ruangan
    $groupedByRuangan = $jadwals->groupBy('id_ruangan');

    $statusList = collect();

    foreach ($query as $stat) {
        foreach ($stat->jadwal as $status) {
            $statusList->push($status->status);
        }
    }

    $statusList = $statusList->unique()->sort();
    $statusLabel  = [
        1 => 'Sebelum UTS',
        2 => 'Sesudah UTS',
    ];
@endphp



<form method="GET" action="{{ route('dashboard.welcome', [$id_kampus, $id_prodi]) }}" class="row g-3 align-items-end">
    <div class="col-md-6">
        <label for="status" class="form-label">Pilih Status</label>
        <select id="status" name="status" class="form-select">
            <option value="">-- Pilih Status --</option>
            @foreach ($statusList as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                    {{ $statusLabel[$status] ?? 'Tidak diketahui' }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-auto">
        <button class="btn btn-primary" type="submit">Terapkan Filter</button>
    </div>
</form>



<div class="container my-4">
    @foreach ($groupedByRuangan as $ruanganId => $items)
        @php
            $namaRuangan = optional($items->first()->ruangan)->nama_ruangan ?? 'Tanpa Nama';
        @endphp

        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white fw-bold">
                Ruangan: {{ $namaRuangan }}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Golongan</th>
                                <th scope="col">Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (
                                $items->sortBy(function ($item) use ($hariOrder) {
                                    $hari = optional($item->jadwal)->hari;
                                    $jam = optional($item->sesi)->start ?? '00:00';
                                    return array_search($hari, $hariOrder) . '-' . $jam;
                                }) as $item
                            )
                                @php
                                    $hariAngka = optional($item->jadwal)->hari;
                                    $jamAwal = optional($item->sesi)->start;
                                    $jamAkhir = optional($item->sesi)->end;
                                    $matkul = optional($item->matkul);
                                    $dosen1 = optional($matkul->pengampuutama)->nama;
                                    $dosen2 = optional($matkul->pengampukedua)->nama;

                                @endphp
                                <tr>
                                    <td>{{ $hariMap[$hariAngka] ?? 'Tidak Diketahui' }}</td>
                                    <td>{{ $jamAwal }} - {{ $jamAkhir }}</td>
                                    <td>{{ $matkul->nama_matkul ?? '-' }}</td>
                                    <td>{{ optional($item->golongan)->nama_golongan }}</td>
                                    <td>
                                        {{ $dosen1 }}
                                        @if ($dosen2)
                                            &amp; {{ $dosen2 }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>




@endsection