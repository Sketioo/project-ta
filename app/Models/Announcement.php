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
        'photos_path',
        'category',
        'is_published',
    ];

    protected $casts = [
        'photos_path' => 'array',
    ];
}