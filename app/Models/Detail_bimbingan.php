<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail_bimbingan extends Model
{
    protected $table = 'detail_bimbingan';
    protected $primaryKey = 'id_d_bimbingan';
    protected $fillable =  ['email', 'nama', 'nim', 'tujuan', 'catatan', 'tanggal', 'id_sesi', 'id_jadwal'];

    /**
     * Get the jadwal that owns the Detail_bimbingan
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
}
