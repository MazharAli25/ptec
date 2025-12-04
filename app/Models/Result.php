<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    protected $fillable= [
        'ExaminationCriteriaID',
        'StudentID',
        'diplomaID',
        'sessionID',
        'semesterID',
        'TheoryMarks',
        'TheoryTotalMarks',
        'PracticalMarks',
        'PracticalTotalMarks',
        'PassingMarks',
        'TotalMarks',
        'ObtainedMarks',
        'Grade',
        'status'
    ];

    public function ExaminationCriteria(){
        return $this->belongsTo(ExaminationCriteria::class, 'ExaminationCriteriaID', 'ID');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'StudentID', 'id');
    }
    public function semester(){
        return $this->belongsTo(Semester::class, 'semesterID', 'id');
    }
    public function session(){
        return $this->belongsTo(mysession::class, 'sessionID', 'id');
    }
}
