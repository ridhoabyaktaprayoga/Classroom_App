<?php

namespace App\Models;

use App\Models\Tugas;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_path',
        'teks_jawaban',
        'nilai',
        'komentar',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    protected $table = 'pengumpulan';

    /**
     * Get the tugas this pengumpulan belongs to
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    /**
     * Get the siswa who submitted this pengumpulan
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
