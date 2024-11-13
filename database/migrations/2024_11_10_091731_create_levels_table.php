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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('avatar')->nullable();
            $table->enum('status', ['APPROVED','PENDING','DISAPPROVED'])->default('PENDING');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // foreign
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
