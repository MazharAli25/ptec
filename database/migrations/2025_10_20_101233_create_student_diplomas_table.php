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
        Schema::create('student_diplomas', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('diploma_id')->constrained('diplomas')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->integer('issue_diploma')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_diplomas');
    }
};
