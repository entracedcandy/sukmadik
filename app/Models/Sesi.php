<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Sesi extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'id_sesi';
    protected $fillable = ['nama_sesi', 'start', 'end',];

    /**
     * Get all of the detail_bimbingan for the sesi
     *
     * @return 
     */
    public function detail_bimbingan(): HasMany
    {
        return $this->hasMany(Detail_bimbingan::class, 'id_sesi', 'id_sesi');
    }

    public function detail_jadwal(): HasMany
    {
        return $this->hasMany(Detail_jadwal::class, 'id_sesi', 'id_sesi');
    }

    public function pengajuan_bimbingan(): HasMany
    {
        return $this->hasMany(Pengajuan_bimbingan::class, 'id_sesi', 'id_sesi');
    }

  
}
