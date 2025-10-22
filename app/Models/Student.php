<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
use App\Models\mysession;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable=[
        'image',
        'instituteId',
        'courseId',
        'name',
        'fatherName',
        'cnic',
        'dob',
        'email',
        'phone',
        'sessionId',
        'address',
    ];

    public function institute() {
        return $this->belongsTo(Institute::class, 'instituteId', 'id');
    }

    public function session() {
        return $this->belongsTo(mysession::class, 'sessionId', 'id');
    }

    public function certificates() {
        return $this->hasMany(Certificate::class);
    }

     public function course() {
        return $this->belongsTo(Course::class, 'courseId', 'id');
    }

    public function certificateRequests() {
        return $this->hasMany(Certificate::class);
    }

    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'studentID');
    }

    public function studentDiplomas()
    {
        return $this->hasMany(StudentDiploma::class, 'student_id');
    }
}
