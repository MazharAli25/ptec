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
            $table->id();
            $table->string('image');
            $table->foreignId('instituteId')->constrained('institutes');
            $table->foreignId('courseId')->constrained('courses');
            $table->string('name');
            $table->string('fatherName');
            $table->integer('phone')->unique();
            $table->string('cnic', 15)->unique();
            $table->string('email')->unique();
            $table->enum('gender',['Male', 'Female', 'Others']);
            $table->string('sessionId');
            $table->string('address');
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
