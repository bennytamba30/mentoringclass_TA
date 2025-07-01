<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'mentor_id',
    ];

    public function mentor()
{
    return $this->belongsTo(User::class, 'mentor_id');
}
}
