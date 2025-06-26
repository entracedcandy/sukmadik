<div>    
    

    <form wire:submit="Simpan">
    @csrf

     @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Email -->
    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input wire:model="SelectedEmail" type="email" name="email" class="form-control" required>
    </div>

    <!-- Nama -->
    <div class="mb-3">
        <label class="form-label">Nama:</label>
        <input wire:model="SelectedNama" type="text" name="nama" class="form-control" required>
    </div>

    <!-- NIM -->
    <div class="mb-3">
        <label class="form-label">NIM:</label>
        <input wire:model="SelectedNIM" type="text" name="nim" class="form-control" required>
    </div>

    <!-- Tujuan -->
    <div class="mb-3">
        <label class="form-label">Tujuan:</label>
        <input wire:model="SelectedTujuan" type="text" name="tujuan" class="form-control" required>
    </div>

    <!-- Catatan -->
    <div class="mb-3">
        <label class="form-label">Catatan:</label>
        <textarea wire:model="SelectedCatatan" name="catatan" class="form-control"></textarea>
    </div>

    <!-- Tanggal -->
    <div class="mb-3"> 
    <label class="form-label">Tanggal:</label>
    <input wire:model="SelectedTanggal" type="date" name="tanggal" class="form-control" required min="{{ \Carbon\Carbon::today()->toDateString() }}">
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
        {{-- <select name="id_kampus" class="form-select" required>
            <option value="">-- Pilih Kampus --</option>
            @foreach ($kampus as $item)
                <option value="{{ $item->id_kampus }}" {{ $item->id_kampus == $id_kampus ? 'selected' : '' }}>
                    {{ $item->nama_kampus }}
                </option>
            @endforeach
        </select> --}}
        @foreach ($kampus as $kampuses ) 
        <input  type="text" class="form-control" name="id_kampus" value="{{ $kampuses->nama_kampus }}" readonly>
        @endforeach
    </div>

    <!-- ID Jurusan -->
    <div class="mb-3">
        <label class="form-label">Jurusan:</label>
            @foreach ($jurusan as $item) 
                 <input type="text" class="form-control" name="id_kampus" value="{{ $item->nama_jurusan }}" readonly>
            @endforeach
    </div>

    <!-- ID Prodi -->
    <div class="mb-3">
        <label class="form-label">Program Studi:</label>
            @foreach ($prodi as $item)
                <input type="text" class="form-control" name="id_kampus" value="{{ $item->nama_prodi }}" readonly>
                </option>
            @endforeach
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

    <div class="mb-3">
    <label class="form-label">Sesi yang Tersedia</label>
    <div class="d-flex gap-2 align-items-end">
        <select wire:model="SelectedSesi" name="id_semester" class="form-select w-auto" required>
            <option value="">-- Pilih Sesi --</option>
            @foreach ($liststatus  as $item)
                <option value="{{ $item->id_sesi }}">{{ $item->start}} - {{ $item->end }} </option>
            @endforeach
        </select>

        <button wire:click="Filtersesi" type="button" class="btn btn-primary">
            Cari Sesi
        </button>
        @error('SelectedTanggal')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


         <button type="submit" class="btn btn-primary">Submit</button>



</form>

</div>
