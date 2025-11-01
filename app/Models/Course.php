<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $table ='courses';

    protected $fillable=[
        'courseName',
        'edit_courseName',
    ];

    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'courseID', 'id');
    }
}
