<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'mentee_id',
        'status',
        'date',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

   
}
