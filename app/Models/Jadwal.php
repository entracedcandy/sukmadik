<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['hari', 'id_golongan', 'id_semester', 'id_semester'];
    
    /**
     * Get the user that owns the jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'id_golongan', 'id_golongan');
    }

    /**
     * Get all of the pengajuan_bimbingan for the jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengajuan_bimbingan(): HasMany
    {
        return $this->hasMany(Pengajuan_bimbingan::class, 'id_jadwal', 'id_jadwal');
    }

    public function detail_bimbingan(): HasMany
    {
        return $this->hasMany(Detail_bimbingan::class, 'id_jadwal', 'id_jadwal');

    }

    public function detail_jadwal(): HasMany
    {
        return $this->hasMany(Detail_jadwal::class, 'id_jadwal', 'id_jadwal');
    }
    

}
