<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = ['nama_prodi', 'id_jurusan'];

    public function jurusan(): BelongsTo {
        return $this->belongsTo(Kampus::class, 'id_jurusan', 'id_jurusan');
    }

    public function user(): HasMany{
        return $this->hasMany(User::class, 'id_prodi', 'id_prodi');
    }

    public function userDosen(): HasMany{
        return $this->hasMany(User::class, 'id_prodi', 'id_prodi')->where('level', 2);
    }


}
