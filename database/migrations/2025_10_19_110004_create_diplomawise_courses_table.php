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
        Schema::create('diplomawise_courses', function (Blueprint $table) {
            $table->id('ID'); 
            $table->foreignId('diplomaID')->constrained('diplomas')->onDelete('cascade');
            $table->foreignId('courseID')->constrained('courses')->onDelete('cascade');
            $table->foreignId('semesterID')->constrained('semesters')->onDelete('cascade');
            $table->foreignId('sessionID')->constrained('mysessions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diplomawise_courses');
    }
};
