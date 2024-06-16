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
        // Schema::create('onboarding_past_employment_details', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->unsignedBigInteger('applicant_id');
        //     $table->foreign('applicant_id')->references('id')->on('onboarding_personal_details')->onDelete('cascade');
        //     $table->string('company_name');
        //     $table->string('brand_name')->default(null);
        //     $table->date('joining_date');
        //     $table->date('releasing_date');
        //     $table->text('resignation_reason');
        //     $table->string('salary_per_month')->default(null);
        //     $table->string('post_name');
        //     $table->string('posting_area');
        //     $table->string('reporting_area');
        //     $table->string('company_contact_number');
        //     $table->string('company_email');
        //     $table->string('company_website')->default(null);
        //     $table->string('uploaded_appointment_letter')->default(null);
        //     $table->string('uploaded_release_letter')->default(null);
        //     $table->string('uploaded_salary_slip')->default(null);
        //     $table->enum('status',array('Active','Inactive'))->default('Active'); 
            
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_past_employment_details');
    }
};
