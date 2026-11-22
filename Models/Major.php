<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    public const DEFAULTS = [
        'RPL' => 'Rekayasa Perangkat Lunak (RPL)',
        'DKV' => 'Design Komunikasi Visual (DKV)',
        'TG' => 'Teknik Grafika (TG)',
        'DG' => 'Design Grafis (DG)',
        'AM' => 'Animasi 2D & 3D (AM)',
        'MLBP' => 'Management Layanan Bisnis Perkantoran (MLBP)',
        'TKJ' => 'Teknik Komputer Jaringan (TKJ)',
        'TAV' => 'Teknik Elektronika Audio Video (TAV)',
        'DPIB' => 'Desain Pemodelan dan Informasi Bangunan (DPIB)',
        'TO' => 'Teknik Otomotif (TO)',
    ];

    protected $fillable = [
        'code',
        'name',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
