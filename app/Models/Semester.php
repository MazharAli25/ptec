<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{

    protected $fillable = [
        'SemesterName',
        'Duration',
    ];

    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'semesterID');
    }

    public function studentDiplomas(){
        return $this->hasMany(StudentDiploma::class, 'semester_id');
    }
}
