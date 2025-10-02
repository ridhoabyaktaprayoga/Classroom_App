<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'kelas_id',
        'user_id',
        'title',
        'content',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class);
    }
}
