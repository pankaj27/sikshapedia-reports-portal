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
        // Schema::create('onboarding_academic_details', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->unsignedBigInteger('applicant_id');
        //     $table->foreign('applicant_id')->references('id')->on('onboarding_personal_details')->onDelete('cascade');
        //     $table->string('course_name');
        //     $table->string('stream_name')->default(null);
        //     $table->string('course_duration')->default(null);
        //     $table->string('registration_no')->default(null);
        //     $table->string('board_name');
        //     $table->string('year_of_passing');
        //     $table->string('total_marks');
        //     $table->string('marks_obtain');
        //     $table->string('percentage');
        //     $table->string('uploaded_marksheet')->default(null);
        //     $table->string('uploaded_registration')->default(null);
        //     $table->string('uploaded_certificate')->default(null);
        //     $table->enum('status',array('Active','Inactive'))->default('Active');            
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_academic_details');
    }
};
