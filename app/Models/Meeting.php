<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'description'];

     protected $casts = [
        'date' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
