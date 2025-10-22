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
        Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
        $table->string('session_name');
        $table->string('course_title');
        $table->date('sessionStart');
        $table->date('sessionEnd');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
