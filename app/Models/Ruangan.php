<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(kampus::class, 'foreign_key', 'other_key');
    }

}
