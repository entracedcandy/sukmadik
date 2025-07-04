<div
    x-data="{ tambahModal: null, editModal: null }"
    x-init="
        tambahModal = new bootstrap.Modal($refs.modalTambahKampus);
        editModal = new bootstrap.Modal($refs.modalEditKampus);

        Livewire.on('close-tambah-modal', () => tambahModal.hide());
        Livewire.on('close-edit-modal', () => editModal.hide());
    "
>
    {{-- Konten Utama --}}
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-left mb-3">
            <h4 class="fw-bold">Setting Prodi</h4>
            <button type="button" class="btn btn-primary" @click="tambahModal.show()">Tambah Prodi</button>
        </div>

        <table class="table align-middle">
    <thead class="bg-light">
        <tr class="text-center">
            <th scope="col">Nama Prodi</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Kampus</th>
            <th></th>
            <th scope="col">Action</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($query as $item)
            <tr class="text-center">
                <td>{{ $item->nama_prodi }}</td>
                <td>{{ optional($item->jurusan)->nama_jurusan }}</td>
                <td>{{ optional($item->jurusan->kampus)->nama_kampus }}</td>
                <td>
                    <button wire:click="delete({{ $item->id_prodi }})" class="btn btn-outline-danger btn-sm px-2">Hapus</button>
                </td>
                <td>
                    <button class="btn btn-outline-info btn-sm px-2" data-bs-toggle="modal" data-bs-target="#modalDetail" wire:click="showDetail({{ $item->id_prodi }})">Detail</button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKampus" wire:click="editKampus({{ $item->id_prodi }})">Edit</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        {{ $query->links() }}
    </div>

    {{-- Modal Detail --}}
    <div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    @if($selectedDetail)
                        <dl class="row">

                            <dt class="col-sm-3">Nama Prodi</dt>
                            <dd class="col-sm-9">{{ $selectedDetail->nama_prodi }}</dd>

                            <dt class="col-sm-3">Kampus</dt>
                            <dd class="col-sm-9">{{ optional($item->jurusan->kampus)->nama_kampus  }}</dd>

                            <dt class="col-sm-3">Jurusan</dt>
                            <dd class="col-sm-9">{{ optional($selectedDetail->jurusan)->nama_jurusan }}</dd>

                            <dt class="col-sm-3">Jumlah dosen</dt>
                            <dd class="col-sm-9">{{ $Countdosen }}</dd>
                        </dl>
                    @else
                        <p class="text-muted">Memuat data...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Kampus --}}
    <div wire:ignore.self class="modal fade" id="modalTambahKampus" tabindex="-1" aria-labelledby="modalTambahKampusLabel" aria-hidden="true" x-ref="modalTambahKampus">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeJurusan">
                        <div class="mb-3">
                            <label for="nama_jurusan" class="form-label">Nama Prodi</label>
                            <input type="text" wire:model.defer="InsertProdi" id="nama_jurusan" class="form-control" placeholder="Masukkan nama jurusan">
                            @error('InsertJurusan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_kampus" class="form-label">Jurusan</label>
                            <select wire:model.defer="InsertJurusan" id="id_kampus" class="form-select">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($listjurusan as $juruasn)
                                    <option value="{{ $juruasn->id_jurusan }}">{{ $juruasn->nama_jurusan }} - {{ optional($juruasn->kampus)->nama_kampus }}</option>
                                @endforeach
                            </select>
                            @error('InsertKampus') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Kampus --}}
    <div wire:ignore class="modal fade" id="modalEditKampus" tabindex="-1" aria-labelledby="modalEditKampusLabel" aria-hidden="true" x-ref="modalEditKampus">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateKampus">
                        <div class="mb-3">
                            <label for="nama_jurusan_edit" class="form-label">Nama Prodi</label>
                            <input type="text" wire:model.defer="EditProdi" id="nama_jurusan_edit" class="form-control">
                            @error('EditProdi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_kampus" class="form-label">Jurusan</label>
                            <select wire:model.defer="EditJurusan" id="id_kampus" class="form-select">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($listjurusan as $juruasn)
                                    <option value="{{ $juruasn->id_jurusan }}">{{ $juruasn->nama_jurusan }} - {{ optional($juruasn->kampus)->nama_kampus }}</option>
                                @endforeach
                            </select>
                            @error('EditJurusan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
