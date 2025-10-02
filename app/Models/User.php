<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\Kelas;
use App\Models\Pengumpulan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }
    
    /**
     * Check if user is a guru
     */
    public function isGuru()
    {
        return $this->role === 'guru';
    }
    
    /**
     * Check if user is a siswa
     */
    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
    
    /**
     * Get kelas created by this user (guru)
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }
    
    /**
     * Get kelas joined by this user (siswa)
     */
    public function kelasSiswa()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }
    
    /**
     * Get pengumpulan submitted by this user
     */
    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class, 'siswa_id');
    }
    
    /**
     * Get discussions created by this user
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
    
    /**
     * Get replies created by this user
     */
    public function discussionReplies()
    {
        return $this->hasMany(DiscussionReply::class);
    }
}
