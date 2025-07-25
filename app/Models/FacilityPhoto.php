<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'photo_path',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
