<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learned_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question')->unique();
            $table->text('answer');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('learned_questions');
    }
};
