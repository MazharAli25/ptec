<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $table ='courses';

    protected $fillable=[
        'courseName',
        'courseDuration',
        'edit_courseName',
        'edit_courseDuration',
    ];

    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'courseID');
    }
}
