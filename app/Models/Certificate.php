<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';
    protected $fillable = ['student_id', 'diplomaID', 'sessionID', 'status'];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'requested_by');
    }

    public function diploma(){
        return $this->belongsTo(Diploma::class, 'diplomaID', 'id');
    }
    public function session(){
        return $this->belongsTo(mysession::class, 'sessionID', 'id');
    }
}
