<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $with = ['subject'];

    protected $fillable = [
        'name',
        'nip',
        'subject_id',
        'start_date',
        'phone',
        'address',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }
}
