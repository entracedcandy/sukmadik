<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detai_pengampu extends Model
{
    protected $table = 'detail_pengampu';
    protected $primaryKey = 'id_pengampu';
    protected $fillable = ['id_pengampu1', 'id_pengampu2', 'id_matkul'];

    /**
     * Get the pengampuutama that owns the Detai_pengampu
     *
     * @return 
     */
    public function pengampuutama(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengampu1', 'id_user');
    }
    
    public function pengampukedua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengampu2', 'id_user');
    }

    public function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }


}
