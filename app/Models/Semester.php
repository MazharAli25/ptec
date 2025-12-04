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
        return $this->hasMany(DiplomawiseCourses::class, 'semesterID', 'id');
    }

    public function studentDiplomas(){
        return $this->hasMany(StudentDiploma::class, 'semester_id');
    }

    public function studentCourses(){
        return $this->hasMany(StudentCourse::class, 'semesterID', 'id');
    }

    public function results(){
        return $this->hasMany(Result::class, 'semesterID', 'id');
    }
    public function studentCard(){
        return $this->hasMany(StudentCard::class, 'semesterID', 'id');
    }
}
