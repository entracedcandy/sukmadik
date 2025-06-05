<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['nama_jurusan', 'id_kampus'];

    public function kampus(): BelongsTo {
        return $this->belongsTo(Kampus::class, 'id_kampus', 'id_kampus');
    }

    public function prodi(): HasMany {
        return $this->hasMany(Prodi::class, 'id_jurusan','id_jurusan');
    }
}
