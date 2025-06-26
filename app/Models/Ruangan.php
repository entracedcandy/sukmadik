<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primarykey = 'id_ruangan';
    protected $fillable =  ['nama_ruangan', 'id_kampus'];

    /**
     * Get the kampus that owns the ruangan
     *
     * @return 
     */
    public function kampus(): BelongsTo
    {
        return $this->belongsTo(kampus::class, 'id_kampus', 'id_kampus');
    }

    public function detail_jadwal(): HasMany
    {
        return $this->hasMany(kampus::class, 'id_ruangan', 'id_ruangan');
    }

}
