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
            <h4 class="fw-bold">Setting Kampus</h4>
            <button type="button" class="btn btn-primary" @click="tambahModal.show()">Tambah Kampus</button>
        </div>

        <table class="table align-middle">
            <thead class="bg-light">
                <tr class="text-center">
                    <th scope="col">Nama Kampus</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $item)
                    <tr class="text-center">
                        <td>{{ $item->nama_kampus }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <button wire:click="delete({{ $item->id_kampus }})" class="btn btn-outline-danger btn-sm px-2">Hapus</button>
                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKampus" wire:click="editKampus({{ $item->id_kampus }})">Edit</button>
                            <button class="btn btn-outline-info btn-sm px-2" data-bs-toggle="modal" data-bs-target="#modalDetail" wire:click="showDetail({{ $item->id_kampus }})">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Detail -->
    <div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Kampus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    @if($selectedDetail)
                        <dl class="row">
                            <dt class="col-sm-3">Kampus</dt>
                            <dd class="col-sm-9">{{ $selectedDetail->nama_kampus }}</dd>

                            <dt class="col-sm-3">Alamat</dt>
                            <dd class="col-sm-9">{{ $selectedDetail->alamat }}</dd>

                            <dt class="col-sm-3">Jurusan</dt>
                            <dd class="col-sm-9">{{ $Countprodi }}</dd>

                            <dt class="col-sm-3">Prodi</dt>
                            <dd class="col-sm-9">{{ $Countjurusan }}</dd>
                        </dl>
                    @else
                        <p class="text-muted">Memuat data...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kampus -->
    <div wire:ignore.self class="modal fade" id="modalTambahKampus" tabindex="-1" aria-labelledby="modalTambahKampusLabel" aria-hidden="true" x-ref="modalTambahKampus">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kampus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeKampus">
                        <div class="mb-3">
                            <label for="nama_kampus" class="form-label">Nama Kampus</label>
                            <input type="text" wire:model.defer="form.nama_kampus" id="nama_kampus" class="form-control" placeholder="Masukkan nama kampus">
                            @error('form.nama_kampus') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea wire:model.defer="form.alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
                            @error('form.alamat') <small class="text-danger">{{ $message }}</small> @enderror
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
                            <label for="nama_kampus_edit" class="form-label">Nama Kampus</label>
                            <input type="text" wire:model.defer="form.nama_kampus" id="nama_kampus_edit" class="form-control">
                            @error('form.nama_kampus') <small class="text-danger">{{ $message }}</small> @enderror
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
