<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- HARUS pakai ini, bukan Eloquent\Model
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->hasMany(Pengajuan_bimbingan::class, 'id_pengampu1', 'id_user');
    }

    public function pegnampukedua(): HasMany
    {
        return $this->hasMany(Pengajuan_bimbingan::class, 'id_pengampu2', 'id_user');
    }
    

    
    
}