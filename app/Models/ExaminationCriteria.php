<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DiplomawiseCourses;
use App\Models\mysession;

class ExaminationCriteria extends Model
{
    protected $table = 'examination_criteria';
    protected $fillable = [
        'DiplomawiseCourseID',
        'sessionID',
        'TheoryMarks',
        'PracticalMarks',
        'TotalMarks',
    ];

    public function diplomawiseCourse()
    {
        return $this->belongsTo(DiplomawiseCourses::class, 'DiplomawiseCourseID', 'ID');
    }

    public function session()
    {
        return $this->belongsTo(mysession::class, 'sessionID', 'ID');
    }

    public function result(){   
        return $this->hasMany(Result::class, 'ExaminationCriteriaID', 'ID');
    }
}
