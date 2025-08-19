<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link_terkait',
        'date',
        'location',
        'is_published',
        'images',
        'translations',
    ];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
        'images' => 'array',
        'translations' => 'array',
    ];

    public function getTranslatedTitleAttribute()
    {
        $locale = App::getLocale();
        if ($locale !== 'id' && !empty($this->translations[$locale]['title'])) {
            return $this->translations[$locale]['title'];
        }
        return $this->title;
    }

    public function getTranslatedDescriptionAttribute()
    {
        $locale = App::getLocale();
        if ($locale !== 'id' && !empty($this->translations[$locale]['description'])) {
            return $this->translations[$locale]['description'];
        }
        return $this->description;
    }
}
