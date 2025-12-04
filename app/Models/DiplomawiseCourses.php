<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomawiseCourses extends Model
{
    protected $table = 'diplomawise_courses';
    protected $fillable = [
        'diplomaID',
        'courseID',
        'semesterID',
        'sessionID'
    ];

    public function diploma()
    {
        return $this->belongsTo(Diploma::class, 'diplomaID', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'courseID', 'id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semesterID', 'id');
    }
    
    public function studentCourses()
    {
        return $this->belongsTo(StudentCourse::class, 'DiplomawiseCourseID');
    }
    public function session()
    {
        return $this->belongsTo(mysession::class, 'sessionID');
    }

    public function examinationCriteria()
    {
        return $this->hasOne(ExaminationCriteria::class, 'DiplomawiseCourseID', 'ID');
    }

}
