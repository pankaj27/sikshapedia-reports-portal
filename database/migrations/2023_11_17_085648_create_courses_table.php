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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('course_code');
            $table->text('course_full_name');
            $table->integer('min_duration')->default(null);
            $table->integer('max_duration')->default(null);
            $table->string('reg_session')->default(null);
            $table->string('exam_reg_session')->default(null);
            $table->string('marks_entry_session')->default(null);
            $table->string('result_session')->default(null);
            $table->integer('graduate_book_sl')->default(null);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
