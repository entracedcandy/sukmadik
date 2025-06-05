<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan_bimbingan extends Model
{
    protected $table = 'pengajuan_bimbingan';
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = [
        'email',
        'nama',
        'nim',
        'tujuan',
        'catatan',
        'tanggal',
        'status',
        'id_user',
        'id_kampus',
        'id_jurusan',
        'id_prodi',
        'id_semester',
        'id_golongan',
        'id_sesi',
        'id_jadwal',
    ];

    /**
     * Get the jurusan that owns the pengajuan_bimbingan
     *
     * @return 
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kampus(): BelongsTo
    {
        return $this->belongsTo(Kampus::class, 'id_kampus', 'id_kampus');
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'id_golongan', 'id_golongan');
    }

    public function sesi(): BelongsTo
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id_sesi');
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
