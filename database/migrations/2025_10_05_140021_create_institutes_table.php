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
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name')->unique();  // added unique here and the migration:fresh isn't runned
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }
//     'instituteName'
// 'address'
// 'directorName'
// 'directorEmail'
// 'phone'
// 'status'
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
// $2y$12$MGUKRihIe1HCL1CKvl6da.QsRA7Hd/J9W540JOHYl8SEN5nUUqzh.
