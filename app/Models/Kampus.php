<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

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

    public function prodi(): HasManyThrough
    {
        return $this->hasManyThrough(Prodi::class, Jurusan::class, 'id_kampus', 'id_jurusan', 'id_kampus', 'id_jurusan');
    }

     public function userDosen()
    {
        return $this->hasManyDeep(
            User::class, // Model target
            [Jurusan::class, Prodi::class], // Model perantara dari Team ke Article
            [
                'id_kampus', // Foreign key di team_user yang menunjuk ke teams.id
                'id_jurusan', // Foreign key di articles yang menunjuk ke users.id
                'id_prodi',
            ],
            [
                'id_kampus', // Local key di teams yang menunjuk ke team_user.team_id
                'id_jurusan',
                'id_prodi', // Local key di users yang menunjuk ke articles.user_id
            ]
        )->where('level', 2);
    }

    


}
