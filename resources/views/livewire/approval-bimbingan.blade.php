<div>
    <div class="container mt-5">
        <h4 class="mb-4 fw-bold">Approval Bimbingan</h4>
        <div class="table-responsive shadow rounded border">
            <table class="table align-middle">
                <thead class="bg-light">
                    <tr class="text-center">
                        <th scope="col" class="py-3">Tanggal</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mahasiswa</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Status Approval</th>
                        <th scope="col">Approval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query as $item)
                        @php
                            $hariMap = [1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu',7=>'Minggu'];
                            $hari = $hariMap[date('N', strtotime($item->tanggal))] ?? '-';
                            $jam = $item->sesi->start ?? '-' . ' - ' . $item->sesi->end ?? '-';
                        @endphp
                        <tr class="text-center">
                            <td class="py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $hari }}</td>
                            <td>{{ $jam }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>
                                @if ($item->status === 'acc')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status === 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($item->status === 'waiting')
                                    <span class="badge bg-secondary">Menunggu Persetujuan</span>
                                @else
                                
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>

                            <td>
                                <button wire:click="approve({{ $item->id_pengajuan }}, 'acc')" class="btn btn-outline-primary btn-sm px-2">Ya</button>
                                <button wire:click="approve({{ $item->id_pengajuan }}, 'ditolak')" class="btn btn-outline-danger btn-sm px-2">Tidak</button>
                                <button class="btn btn-outline-info btn-sm px-2" data-bs-toggle="modal" data-bs-target="#modalDetail" wire:click="showDetail({{ $item->id_pengajuan }})">Detail</button>
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
        <h5 class="modal-title" id="modalDetailLabel">Detail Bimbingan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        @if($selectedDetail)
        <dl class="row">
          <dt class="col-sm-3">Email</dt>
          <dd class="col-sm-9">{{ $selectedDetail->email }}</dd>

          <dt class="col-sm-3">Nama</dt>
          <dd class="col-sm-9">{{ $selectedDetail->nama }}</dd>

          <dt class="col-sm-3">NIM</dt>
          <dd class="col-sm-9">{{ $selectedDetail->nim }}</dd>

          <dt class="col-sm-3">Tujuan</dt>
          <dd class="col-sm-9">{{ $selectedDetail->tujuan }}</dd>

          <dt class="col-sm-3">Catatan</dt>
          <dd class="col-sm-9">{{ $selectedDetail->catatan }}</dd>

          <dt class="col-sm-3">Tanggal</dt>
          <dd class="col-sm-9">{{ \Carbon\Carbon::parse($selectedDetail->tanggal)->format('d M Y') }}</dd>

          <dt class="col-sm-3">Status</dt>
          <dd class="col-sm-9">
            @if($selectedDetail->status === 1)
                <span class="badge bg-success">Disetujui</span>
            @elseif($selectedDetail->status === 0)
                <span class="badge bg-danger">Ditolak</span>
            @else
                <span class="badge bg-secondary">Belum</span>
            @endif
          </dd>
        </dl>
        @else
        <p class="text-muted">Memuat data...</p>
        @endif
      </div>
    </div>
  </div>
</div>
    </div>
</div>
