<div
    x-data="{ tambahModal: null, editModal: null }"
    x-init="
        tambahModal = new bootstrap.Modal($refs.modalTambahKampus);
        editModal = new bootstrap.Modal($refs.modalEditKampus);

        Livewire.on('close-modal', () => {
            if (tambahModal) tambahModal.hide();
            if (editModal) editModal.hide();
        });
    "
>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Setting Sesi</h4>
            <button type="button" class="btn btn-primary" @click="tambahModal.show()">Tambah sesi</button>
        </div>

        <table class="table align-middle">
            <thead class="bg-light">
                <tr class="text-center">
                    <th scope="col">Nama Sesi</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $item)
                    <tr class="text-center">
                        <td>{{ $item->nama_sesi }}</td>
                        <td>{{ $item->start }}</td>
                        <td>{{ $item->end }}</td>
                        <td>
                            <button wire:click="delete({{ $item->id_sesi }})" class="btn btn-outline-danger btn-sm px-2">Hapus</button>
                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKampus" wire:click="editKampus({{ $item->id_sesi }})">Edit</button>
                            {{-- <button class="btn btn-outline-info btn-sm px-2" data-bs-toggle="modal" data-bs-target="#modalDetail" wire:click="showDetail({{ $item->id_sesi }})">Detail</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Detail -->
    {{-- <div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Sesi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    @if($selectedDetail)
                        <dl class="row">
                            <dt class="col-sm-3">Nama Sesi</dt>
                            <dd class="col-sm-9">{{ $selectedDetail->nama_sesi }}</dd>

                            <dt class="col-sm-3">Alamat</dt>
                            <dd class="col-sm-9">{{ $selectedDetail->alamat }}</dd>

                            <dt class="col-sm-3">Jurusan</dt>
                            <dd class="col-sm-9">{{ $Countprodi }}</dd>

                        </dl>
                    @else
                        <p class="text-muted">Memuat data...</p>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Tambah Kampus -->
    <div wire:ignore.self class="modal fade" id="modalTambahKampus" tabindex="-1" aria-labelledby="modalTambahKampusLabel" aria-hidden="true" x-ref="modalTambahKampus">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sesi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeKampus">
                        <div class="mb-3">
                            <label for="nama_sesi" class="form-label">Nama Sesi</label>
                            <input type="text" wire:model.defer="InsertNama" id="nama_sesi" class="form-control" placeholder="Masukkan nama sesi">
                            @error('InsertNama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                         <div class="mb-3">
                            <label for="start" class="form-label">Jam Mulai</label>
                            <input type="time" wire:model.defer="InsertStart" id="start" class="form-control">
                            @error('InsertStart') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="End" class="form-label">Jam Mulai</label>
                            <input type="time" wire:model.defer="InsertEnd" id="End" class="form-control">
                            @error('InsertEnd') <small class="text-danger">{{ $message }}</small> @enderror
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

    <!-- Modal Edit Kampus -->
    <div wire:ignore.self class="modal fade" id="modalEditKampus" tabindex="-1" aria-labelledby="modalEditKampusLabel" aria-hidden="true" x-ref="modalEditKampus">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kampus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateKampus">
                        <div class="mb-3">
                            <label for="nama_sesi_edit" class="form-label">Nama Kampus</label>
                            <input type="text" wire:model.defer="form.nama_sesi" id="nama_sesi_edit" class="form-control">
                            @error('form.nama_sesi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat_edit" class="form-label">Alamat</label>
                            <textarea wire:model.defer="form.alamat" id="alamat_edit" class="form-control" rows="3"></textarea>
                            @error('form.alamat') <small class="text-danger">{{ $message }}</small> @enderror
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
