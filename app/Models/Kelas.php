<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'deskripsi',
        'guru_id',
    ];

    /**
     * Get the guru who created this class
     */
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    /**
     * Get the siswa enrolled in this class
     */
    public function siswa()
    {
        return $this->belongsToMany(User::class, 'kelas_siswa', 'kelas_id', 'siswa_id')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    /**
     * Get the materi in this class
     */
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    /**
     * Get the tugas in this class
     */
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    
    /**
     * Get the discussions in this class
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
