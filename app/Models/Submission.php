<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'mentee_id',
        'file_path',
        'grade',
        'feedback',
        'submitted_at',
    ];

   // Relasi ke Assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Relasi ke Mentee
        public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id')->where('role', 'mentee');
    }

}

