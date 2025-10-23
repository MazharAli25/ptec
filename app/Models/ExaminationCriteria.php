<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DiplomawiseCourses;

class ExaminationCriteria extends Model
{
    protected $table = 'examination_criteria';
    protected $fillable = [
        'DiplomawiseCourseID',
        'TheoryMarks',
        'PracticalMarks',
        'TotalMarks',
    ];

    public function diplomawiseCourse()
    {
        return $this->belongsTo(DiplomawiseCourses::class, 'DiplomawiseCourseID', 'ID');
    }
}
