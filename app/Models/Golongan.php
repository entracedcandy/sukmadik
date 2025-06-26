<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongan';
    protected $primaryKey = 'id_golongan';
    protected $fillable = ['nama_golongan', 'status'];

    // public function detailsesi() {
    //     return $this->hasMany(detailsesi::class, 'id_golongan');
    // }

}
