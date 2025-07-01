<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // admin, mentor, mentee
        'mentor_id',
        'nim',
        'kelas',
        'photo',       // path relatif ke storage
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Role Checkers
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMentor(): bool
    {
        return $this->role === 'mentor';
    }

    public function isMentee(): bool
    {
        return $this->role === 'mentee';
    }

    /**
     * Relasi
     */
 

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'mentor_id');
    }

    public function mentees(): HasMany
    {
        return $this->hasMany(User::class, 'mentor_id')->where('role', 'mentee');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id')->where('role', 'mentor');
    }

    /**
     * Get URL foto user (helper untuk digunakan di mana saja)
     */
    public function getPhotoUrl(): string
    {
        return $this->photo
            ? Storage::url($this->photo)
            : url('/default-avatar.png'); // fallback default avatar
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'mentor_id');
    }

}
