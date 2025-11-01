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
        Schema::create('examination_criteria', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('DiplomawiseCourseID')->constrained('diplomawise_courses')->onDelete('cascade');
            $table->foreignId('sessionID')->constrained('mysessions')->onDelete('cascade');
            $table->integer('TheoryMarks');
            $table->integer('PracticalMarks')->nullable();
            $table->integer('TotalMarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_criterias');
    }
};
