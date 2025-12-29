<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable= [
        'quizName',
        'description'
    ];

    public function questions()
    {
        return $this->hasMany(questions::class, 'quiz_id', 'id');
    }

    public function studentQuizzes()
    {
        return $this->hasMany(StudentQuiz::class, 'quizId', 'id');
    }
}
