<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';
    protected $fillable = ['nama_matkul', 'id_prodi', 'id_semester'];

    /**
     * Get the prodi that owns the matkul
     *
     * @return 
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function pengampuutama(): BelongsTo
    {
    return $this->belongsTo(User::class, 'id_pengampu1', 'id_user');
    }
    
    public function pengampukedua(): BelongsTo
    {
    return $this->belongsTo(User::class, 'id_pengampu2', 'id_user');
    }

    /**
     * Get the user that owns the Matkul
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }

    

    /**
     * Get all of the detail_jadwal for the matkul
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_jadwal(): HasMany
    {
        return $this->hasMany(Detail_jadwal::class, 'id_matkul', 'id_matkul');
    }

    
}
