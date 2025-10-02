<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Pengumpulan;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = [
        'kelas_id',
        'judul',
        'deskripsi',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * Get the kelas this tugas belongs to
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Get the pengumpulan for this tugas
     */
    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class);
    }
}
