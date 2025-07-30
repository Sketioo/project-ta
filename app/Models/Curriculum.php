<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curricula';

    protected $fillable = [
        'name',
        'description',
        'is_visible',
    ];

    public function images()
    {
        return $this->hasMany(CurriculumImage::class);
    }
}
