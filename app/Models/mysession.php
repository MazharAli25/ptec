<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mysession extends Model
{
    public $table = 'mysessions';

    protected $fillable = [
        'session',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'student_id');
    }

    public function diplomas()
    {
        return $this->hasMany(Diploma::class, 'SessionID');
    }

    public function examinationCriterias()
    {
        return $this->hasMany(ExaminationCriteria::class, 'sessionID');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'sessionID', 'id');
    }
    public function result()
    {
        return $this->hasMany(Result::class, 'sessionID', 'id');
    }

    public function studentCard()
    {
        return $this->hasMany(StudentCard::class, 'sessionID', 'id');
    }

    public function diplomaWiseCourses()
    {
        return $this->hasMany(mysession::class, 'sessionID', 'id');
    }

    public function studentDiplomas(){
        return $this->hasOne(StudentDiploma::class, 'session_id', 'id');
    }
}
