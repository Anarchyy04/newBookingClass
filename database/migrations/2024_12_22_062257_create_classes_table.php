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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('room'); 
            $table->integer('capacity'); 
            $table->string('day'); 
            $table->time('start_time'); 
            $table->time('end_time'); 
            $table->unsignedBigInteger('teacher_id'); 
            $table->timestamps();
        
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
