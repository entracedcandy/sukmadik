<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- HARUS pakai ini, bukan Eloquent\Model
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable // <- HARUS pakai Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'user';

    protected $primaryKey = 'id_user';
    

    protected $fillable = ['nip', 'nama', 'email', 'level', 'password', 'id_prodi'];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_user', 'id_user');
    }

    public function pengampuutama(): HasMany
    {
        return $this->hasMany(Matkul::class, 'id_pengampu1', 'id_user');
    }

    public function pengampukedua(): HasMany
    {
        return $this->hasMany(Matkul::class, 'id_pengampu2', 'id_user');
    }

  
    public function detail_jadwal(): HasManyThrough
    {
        return $this->hasManyThrough(Detail_jadwal::class, Jadwal::class, 'id_user','id_jadwal','id_user','id_jadwal');
    }

    public function detail_bimbingan(): HasManyThrough
    {
        return $this->hasManyThrough(Detail_bimbingan::class, Jadwal::class, 'id_user','id_jadwal','id_user','id_jadwal');
    }

    
    
}