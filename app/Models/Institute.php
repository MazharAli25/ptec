<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $fillable = [
        'institute_name',
        'address'
    ];

    public function admins() {
        return $this->hasMany(Admin::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function certificateStudents(){
        return $this->hasMany(Student::class, 'certificateStudentId', 'id');
    }
}
