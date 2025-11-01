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
        Schema::create('students', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('image')->nullable();
            $table->foreignId('instituteId')->constrained('institutes');
            // $table->foreignId('courseId')->constrained('courses');
            $table->string('name');
            $table->string('fatherName');
            $table->string('phone', 15)->unique();
            $table->string('cnic', 15)->unique();
            $table->string('dob')->nullable();
            $table->string('email')->unique();
            $table->enum('gender',['Male', 'Female', 'Others']);
            $table->date('joiningDate');
            // $table->string('sessionId');
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
