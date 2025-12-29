<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Change from extending Model to extending Authenticatable
class Student extends Authenticatable
{
    protected $table = 'students';

    protected $fillable = [
        'image',
        'instituteId',
        'certificateInstituteId',
        // 'courseId',
        'name',
        'fatherName',
        'cnic',
        'dob',
        'email',
        'password',
        'phone',
        // 'sessionId',
        'address',
        'joiningDate',
        'from',
        'to',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'instituteId', 'id');
    }

    public function session()
    {
        return $this->belongsTo(mysession::class, 'sessionId', 'id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId', 'id');
    }

    public function certificateRequests()
    {
        return $this->hasMany(Certificate::class);
    }

    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'studentID');
    }

    public function studentDiplomas()
    {
        return $this->hasMany(StudentDiploma::class, 'student_id', 'id');
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'StudentID', 'id');
    }

    public function studentCard()
    {
        return $this->hasMany(StudentCard::class);
    }

    public function certificateInstitute()
    {
        return $this->belongsTo(Institute::class, 'certificateInstituteId', 'id');
    }

    public function studentQuizzes()
    {
        return $this->hasMany(StudentQuiz::class, 'studentId', 'id');
    }
}
