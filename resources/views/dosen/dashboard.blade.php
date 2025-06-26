@extends('dosen.layout')

@section('dsnsection')


<h2>Selamat datang {{ $user->nama }}</h2>

<br>
<br>

<h6> Berikut ada jadwal kegiatan selama seminggu anda </h6>

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

@if($query->isEmpty())
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