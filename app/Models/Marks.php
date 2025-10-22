<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $table = 'marks';
    protected $fillable = ['marks', 'subject_id']; 

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
