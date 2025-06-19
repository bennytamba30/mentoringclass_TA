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
        'posted_by',
        'visible_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
