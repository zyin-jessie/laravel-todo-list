<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'priority',
        'deadline',
        'completed_at'
    ];

    protected $casts = [
        'deadline' => 'date',
        'completed_at' => 'datetime',
    ];
}
