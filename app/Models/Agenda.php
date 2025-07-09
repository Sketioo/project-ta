<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'is_published',
        'images',
    ];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
        'images' => 'array',
    ];
}
