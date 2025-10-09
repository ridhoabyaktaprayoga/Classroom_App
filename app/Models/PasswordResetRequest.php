<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'status',
        'token',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
