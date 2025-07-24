<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'website_url',
        'contact_person',
        'province_id',
        'regency_id',
        'detail_alamat',
        'deskripsi',
        'is_visible',
    ];
}
