<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCard extends Model
{
    protected $table= 'student_cards';
    protected $fillable = [
        'studentID',
        'diplomaID',
        'sessionID',
        'semesterID',
        'status'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'studentID', 'id');
    }
    public function diploma(){
        return $this->belongsTo(diploma::class, 'diplomaID', 'id');
    }
    public function session(){
        return $this->belongsTo(mysession::class, 'sessionID', 'id');
    }
    public function semester(){
        return $this->belongsTo(Semester::class, 'semesterID', 'id');
    }
}
