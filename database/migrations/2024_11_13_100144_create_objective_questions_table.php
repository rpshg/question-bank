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
        Schema::create('objective_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('lesson_id');

            $table->longText('question',255);
            $table->longText('correct_answer')->nullable();
            $table->longText('option_1')->nullable();
            $table->longText('option_2')->nullable();
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();
            $table->longText('option_5')->nullable();
            $table->longText('option_6')->nullable();
            $table->longText('explanation')->nullable();

            $table->enum('status', ['APPROVED','PENDING','DISAPPROVED'])->default('PENDING');

            $table->softDeletes();
            $table->timestamps();

            // foreign
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objective_questions');
    }
};
