<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}
