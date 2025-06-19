<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin, mentor, mentee
    ];

    /**
     * Role checkers
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMentor()
    {
        return $this->role === 'mentor';
    }

    public function isMentee()
    {
        return $this->role === 'mentee';
    }

    /**
     * Relasi tambahan sesuai kebutuhan
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'posted_by');
    }

    public function courses()
    {
        // Untuk mentor
        return $this->hasMany(Course::class, 'mentor_id');
    }

    public function mentees()
    {
        // Untuk mentor melihat mentee-nya
        return $this->hasMany(User::class, 'mentor_id')->where('role', 'mentee');
    }

    public function mentor()
    {
        // Untuk mentee melihat siapa mentor-nya
        return $this->belongsTo(User::class, 'mentor_id')->where('role', 'mentor');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
