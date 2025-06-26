@extends('mahasiswa.layout')

@section('mhssection')

@php
    $namaHari = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];
@endphp

<h1>Ketersediaan Sesi</h1>

<form method="GET" action="{{ route('mahasiswa.index', [$id_kampus, $id_prodi]) }}">
    <select name="dosen">
        <option value="">Pilih Dosen</option>
        @foreach ($listdosen as $dosen)
            <option value="{{ $dosen->id_user }}" {{ request('dosen') == $dosen->id_user ? 'selected' : '' }}>
                {{ $dosen->nama }}
            </option>
        @endforeach
    </select>

    <select name="semester">
        <option value="">Pilih Semester</option>
        @foreach ($listSemester as $semester)
            <option value="{{ $semester->id_semester }}" {{ request('semester') == $semester->id_semester ? 'selected' : '' }}>
                {{ $semester->nama_semester }}
            </option>
        @endforeach
    </select>

    <button type="submit">Terapkan Filter</button>
</form>


@php
    $grouped = $query->groupBy('id_user');
@endphp

@foreach ($grouped as $id_user => $items)
    <div class="mb-6 border rounded shadow">
        <div class="bg-green-600 text-white font-bold px-4 py-2">
            {{ $items->first()->nama ?? '-' }}
        </div>
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-2 py-1">Hari</th>
                    <th class="border px-2 py-1">Mata Kuliah</th>
                    <th class="border px-2 py-1">Sesi</th>
                    {{-- <th class="border px-2 py-1">Ruangan</th> --}}
                    <th class="border px-2 py-1">Golongan</th>
                    {{-- <th class="border px-2 py-1">Semester</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($items->sortBy([
                    fn($a, $b) => ($a->hari <=> $b->hari) ?: strcmp($a->start, $b->start)
                ]) as $jadwal)
                    <tr>
                        <td class="border px-2 py-1">
                            {{ $namaHari[$jadwal->hari] ?? '-' }}
                        </td>
                        <td class="border px-2 py-1">{{ $jadwal->nama_matkul ?? 'Jam Kosong' }}</td>
                        <td class="border px-2 py-1">{{ $jadwal->start ?? '-' }} - {{ $jadwal->end ?? '' }}</td>
                        {{-- <td class="border px-2 py-1">{{ $jadwal->nama_ruangan ?? '-' }}</td> --}}
                        <td class="border px-2 py-1">{{ $jadwal->nama_golongan ?? '-' }}</td>
                        {{-- <td class="border px-2 py-1">
                            {{ $listSemester->firstWhere('id_semester', $jadwal->id_semester)->nama_semester ?? '-' }}
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach

@endsection
