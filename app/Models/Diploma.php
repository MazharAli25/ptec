<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DiplomawiseCourses;
use App\Models\mysession;

class Diploma extends Model
{
    protected $table = 'diplomas';
    protected $fillable = [
        'SessionID',
        'DiplomaName',
    ];
    
    public function diplomawiseCourses()
    {
        return $this->hasMany(DiplomawiseCourses::class, 'diplomaID');
    }

    public function session()
    {
        return $this->belongsTo(mysession::class, 'SessionID');
    }

    public function studentDiplomas()
    {
        return $this->hasMany(StudentDiploma::class, 'diploma_id');
    }
}
