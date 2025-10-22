<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable= [
        'name',
    ];

    public function marks() :HasOne
    {
        return $this->hasOne(Marks::class, 'subject_id', 'id');
    }
}
