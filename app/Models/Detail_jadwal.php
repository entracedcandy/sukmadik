<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail_jadwal extends Model
{
    protected $table = 'detail_jadwal';
    protected $primaryKey = 'id_d_jadwal';
    protected $fillable = ['id_sesi', 'id_matkul', 'id_ruangan', 'id_jadwal'];

    /**
     * Get the jadwal that owns the Detail_jadwal
     *
     * @return 
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function sesi(): BelongsTo
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id_sesi');
    }
    
}
