<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDiploma extends Model
{
    protected $table= 'student_diplomas';
    protected $primaryKey= 'ID';
    protected $fillable = [
        'student_id',
        'diploma_id',
        'semester_id',
        'session_id',
        'issue_diploma',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function diploma()
    {
        return $this->belongsTo(Diploma::class, 'diploma_id', 'id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function session(){
        return $this->belongsTo(mysession::class, 'session_id', 'id');
    }

    public function studentCourses(){
        return $this ->hasMany(StudentCourse::class, 'StudentDiplomaID', 'ID');
    }
}
