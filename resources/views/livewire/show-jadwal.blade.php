<div>
    <h1>Jadwal Mata Kuliah untuk {{ $namaProdi ?? 'Prodi Tertentu' }}</h1>

<div class="flex gap-4 mb-4">
    <div>
        <label for="selectedDosenInput" class="block text-sm font-semibold mb-1">Filter Dosen</label>
        <select wire:model="selectedDosenInput" id="selectedDosenInput" class="form-select">
            <option value="">Pilih Dosen</option>
            @foreach ($listDosen as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="selectedSemesterInput" class="block text-sm font-semibold mb-1">Filter Semester</label>
        <select wire:model="selectedSemesterInput" id="selectedSemesterInput" class="form-select">
            <option value="">Pilih Semester</option>
            @foreach ($listSemester as $semester)
                <option value="{{ $semester->id }}">{{ $semester->nama_semester }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex items-end">
        <button wire:click="applyFilter" class="px-4 py-2 bg-blue-600 text-white rounded">Terapkan Filter</button>
    </div>
</div>


  @foreach ($query as $dosen)
    @if ($dosen->detail_jadwal->count())
        <div class="mb-6 border rounded shadow">
            <div class="bg-green-600 text-white font-bold px-4 py-2">
                {{ $dosen->nama }}
            </div>
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-2 py-1">Hari</th>
                        <th class="border px-2 py-1">Mata Kuliah</th>
                        <th class="border px-2 py-1">Sesi</th>
                        <th class="border px-2 py-1">Ruangan</th>
                        <th class="border px-2 py-1">Golongan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen->detail_jadwal->sortBy(fn($j) => $j->jadwal->hari ?? 0) as $jadwal)
                        <tr>
                            <td class="border px-2 py-1">{{ $jadwal->jadwal->hari ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $jadwal->matkul->nama_matkul ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $jadwal->sesi->start ?? '-' }} - {{ $jadwal->sesi->end ?? '' }}</td>
                            <td class="border px-2 py-1">{{ $jadwal->ruangan->nama_ruangan ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $jadwal->golongan->nama_golongan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endforeach
