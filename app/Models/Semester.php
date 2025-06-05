<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $primaryKey = 'id_semester';
    protected $fillable = ['nama_semester', 'status',];

    // public function jadwal()
    // {
    //     return $this->hasMany(jadwal::class, 'id_semester');
    // }

    // public function pengajuan_bimbingan()
    // {
    //     return $this->hasMany(pengajuan_bimbingan::class, 'id_semester');
    // }
}
