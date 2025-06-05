<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Kampus extends Model
{
    protected $table = 'kampus';
    protected $primaryKey = 'id_kampus';
    protected $fillable = ['nama_kampus', 'alamat'];

    public function jurusan(): HasMany{
        return $this->hasMany(Jurusan::class, 'id_kampus', 'id_kampus');
    }

    public function ruangan(): HasMany
    {
        return $this->hasMany(Ruangan::class, 'id_kampus', 'id_kampus');
    }
}
