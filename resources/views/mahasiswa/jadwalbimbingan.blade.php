@extends('mahasiswa.layout')

@section('mhssection')

@php
    $selectedDosen = request()->get('dosen');
    $filterStatus = request()->get('status', 1);

    $statusLabel = [
        1 => 'Sebelum UTS',
        2 => 'Sesudah UTS'
    ];

    $hariMap = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];
@endphp

<div class="container my-4">
    <form method="GET" action="{{ route('mahasiswa.index', [$id_kampus, $id_prodi]) }}" class="row g-3 align-items-end">
        <div class="col-md-6">
            <label for="dosen" class="form-label">Pilih Dosen</label>
            <select id="dosen" name="dosen" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach ($listdosen as $dosen)
                    <option value="{{ $dosen->id_user }}" {{ request('dosen') == $dosen->id_user && $selectedDosen == $dosen->id_user ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="status" class="form-label">Status Jadwal</label>
            <select id="status" name="status" class="form-select">
                @foreach ($statusLabel as $key => $label)
                    <option value="{{ $key }}" {{ $filterStatus == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Terapkan</button>
        </div>
    </form>
</div>

@if (!$selectedDosen)
    <div class="alert alert-warning text-center mt-3">
        Silakan pilih dosen terlebih dahulu untuk menampilkan data.
    </div>
@elseif ($query->isEmpty())
    <div class="alert alert-info text-center mt-3">
        Tidak ada data jadwal atau bimbingan yang ditemukan.
    </div>
@else
    @foreach ($query->sortKeys() as $hari => $items)
        <div class="card mb-4 shadow">
            <div class="card-header bg-dark text-white fw-bold">
                Hari: {{ $hariMap[$hari] ?? 'Tidak Diketahui' }}
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Jam</th>
                            <th>Mata Kuliah / Bimbingan</th>
                            <th>Golongan</th>
                            <th>Nama Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Urutkan sesi berdasarkan jam mulai
                            $itemsBySesi = $items->sortBy(fn($item) => optional($item->sesi)->start)->groupBy('id_sesi');
                        @endphp

                        @foreach ($itemsBySesi as $idSesi => $group)
                            @php
                                $first = $group->first();
                                $sesi = $first->sesi;
                                $jam = $sesi ? $sesi->start . ' - ' . $sesi->end : '-';

                                $bimbingan = $group->first(fn($item) => isset($item->tujuan));
                                $kuliah = $group->first(fn($item) => isset($item->id_matkul));


                                if ($bimbingan) {

                                    $namaMatkul = $bimbingan->tujuan . ' ('. $bimbingan->nama. ' - ' . $bimbingan->nim . ' ) '   ?? 'Bimbingan';
                                    $golongan = optional($bimbingan->golongan)->nama_golongan ?? '-';
                                    $namaUser = optional($bimbingan->jadwal->user)->nama  ?? '-';
                                } elseif ($kuliah) {
                                    $namaMatkul = optional($kuliah->matkul)->nama_matkul ?? 'Jam Kosong';
                                    $golongan = optional($kuliah->golongan)->nama_golongan ?? '-';
                                    $namaUser = optional($kuliah->matkul?->pengampuutama)->nama ?? '-';
                                    $pengampu2 = optional($kuliah->matkul?->pengampukedua)->nama;
                                    if ($pengampu2) {
                                        $namaUser .= ' & ' . $pengampu2;
                                    }
                                } else {
                                    $namaMatkul = 'Jam Kosong';
                                    $golongan = '-';
                                    $namaUser = '-';
                                }
                            @endphp
                            <tr>
                                <td>{{ $jam }}</td>
                                <td>{{ $namaMatkul }}</td>
                                <td>{{ $golongan }}</td>
                                <td>{{ $namaUser }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endif

@endsection
