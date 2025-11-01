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
}
