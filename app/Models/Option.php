<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    protected $fillable = [
        'question_id',
        'options',
        'is_correct',
    ];

    public function question()
    {
        return $this->belongsTo(questions::class, 'question_id', 'id');
    }

}
