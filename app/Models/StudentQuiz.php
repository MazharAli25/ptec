<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    protected $table = 'student_quizzes';

    protected $fillable = ['studentId', 'quizId', 'from', 'To'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentId');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quizId');
    }
}
