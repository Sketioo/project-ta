<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'image_path',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
