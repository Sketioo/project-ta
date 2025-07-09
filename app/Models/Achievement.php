<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'semester',
        'class',
        'title',
        'description',
        'file_path',
        'status',
        'validated_by',
        'validated_at',
        'show_on_main_page',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}