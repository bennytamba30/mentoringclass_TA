<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'meeting_id',
        'title',
        'description',
    ];

    // Relasi ke mentor (User dengan role mentor)
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id')->where('role', 'mentor');
        
    }
    public function meeting()
     { 
        return $this->belongsTo(Meeting::class); 
    }

    // Relasi ke modul (tiap minggu)
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // Relasi ke assignments (jika ada langsung di tingkat course, walau idealnya dari modul)
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
