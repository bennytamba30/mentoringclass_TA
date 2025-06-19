<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
    ];

    // Relasi ke course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Absensi per pertemuan modul
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Tambahan: satu module bisa punya beberapa assignments
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
