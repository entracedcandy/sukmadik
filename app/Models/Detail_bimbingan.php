<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class Detail_bimbingan extends Model
{
    protected $table = 'detail_bimbingan';
    protected $primaryKey = 'id_d_bimbingan';
    protected $fillable =  ['email', 'nama', 'nim', 'tujuan', 'catatan', 'tanggal', 'id_sesi', 'id_jadwal', 'id_golongan', 'id_semester'];

    /**
     * Get the jadwal that owns the Detail_bimbingan
     * 
     *
     * @return 
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function sesi(): BelongsTo
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id_sesi');
    }

        public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'id_golongan', 'id_golongan');
    }

        public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    // Di model DetailJadwal.php
    public function detail_jadwal()
    {
        return $this->hasOne(Detail_Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

}
