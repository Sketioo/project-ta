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
        'nama',
        'nama_kompetisi',
        'tingkat_kompetisi',
        'penyelenggara',
        'prestasi',
        'tanggal_pelaksanaan',
        'dosen_pembimbing',
        'file_sertifikat',
        'keterangan_lomba',
        'status',
        'validated_by',
        'validated_at',
        'show_on_main_page',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}