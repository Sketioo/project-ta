<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'is_visible', 'translations'];

    protected $casts = [
        'translations' => 'array',
        'is_visible' => 'boolean',
    ];

    public function getTranslatedQuestionAttribute()
    {
        $locale = App::getLocale();
        if ($locale !== 'id' && !empty($this->translations[$locale]['question'])) {
            return $this->translations[$locale]['question'];
        }
        return $this->question;
    }

    public function getTranslatedAnswerAttribute()
    {
        $locale = App::getLocale();
        if ($locale !== 'id' && !empty($this->translations[$locale]['answer'])) {
            return $this->translations[$locale]['answer'];
        }
        return $this->answer;
    }
}
