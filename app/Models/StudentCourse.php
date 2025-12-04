<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table= 'student_courses';
    protected $primaryKey= 'ID';
    protected $fillable=[
        'StudentDiplomaID',
        'semesterID',
        'DiplomawiseCourseID',
    ];

    public function studentDiploma(){
        return $this->belongsTo(StudentDiploma::class, 'StudentDiplomaID', 'ID');
    }

    public function diplomawiseCourse(){
        return $this->belongsTo(DiplomawiseCourses::class, 'DiplomawiseCourseID');
    }

    public function semester(){
        return $this->belongsTo(Semester::class, 'semesterID', 'id');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'ExaminationCriteriaID', 'ExaminationCriteriaID')
                    ->where('StudentID', $this->StudentID);
    }
}
