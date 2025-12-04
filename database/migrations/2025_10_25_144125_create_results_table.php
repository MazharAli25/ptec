<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ExaminationCriteriaID')->constrained('examination_criteria', 'ID');
            $table->foreignId('StudentID')->constrained('students');
            $table->foreignId('diplomaID')->constrained('diplomas');
            $table->foreignId('sessionID')->constrained('mysessions');
            $table->foreignId('semesterID')->constrained('semesters');
            $table->integer('TheoryTotalMarks');
            $table->integer('TheoryMarks');
            $table->integer('PracticalTotalMarks');
            $table->integer('PracticalMarks');
            $table->integer('PassingMarks');
            $table->integer('TotalMarks');
            $table->integer('ObtainedMarks');
            $table->string('Grade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
