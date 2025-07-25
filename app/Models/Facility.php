<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'person_in_charge',
    ];

    public function photos()
    {
        return $this->hasMany(FacilityPhoto::class);
    }
}
