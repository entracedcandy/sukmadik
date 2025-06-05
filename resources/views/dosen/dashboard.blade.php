@extends('dosen.layout')

@section('dsnsection')
    <div class="container mx-auto p-4">
        @foreach ($hariList as $hari)
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">{{ $hari }}</h2>
                <table class="min-w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 w-1/3">Waktu</th>
                            <th class="border px-4 py-2">Kegiatan / Topik Bimbingan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sesis as $sesi)
                            <tr>
                                <td class="border px-4 py-2">{{ $sesi->jam }}</td>
                                <td class="border px-4 py-2">
                                    @php
                                        $data = $detailSesis->first(function ($item) use ($hari, $sesi) {
                                            return strtolower($item->jadwal->hari) == strtolower($hari) &&
                                                   $item->id_sesi == $sesi->id;
                                        });
                                    @endphp

                                    @if ($data)
                                        <div>
                                            <strong>{{ $data->matkul->nama_matkul ?? '-' }}</strong><br>
                                            @if ($data->pengajuanBimbingan)
                                                <span>Mahasiswa: {{ $data->pengajuanBimbingan->nama_pengaju }}</span>
                                            @endif
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection