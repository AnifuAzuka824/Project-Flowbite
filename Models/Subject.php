<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'major_id',
        'description',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'subject_id');
    }
}
