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
        // Schema::create('onboarding_bank_details', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->unsignedBigInteger('applicant_id');
        //     $table->foreign('applicant_id')->references('id')->on('onboarding_personal_details')->onDelete('cascade');
        //     $table->string('account_name');
        //     $table->string('bank_name');
        //     $table->string('branch_name');
        //     $table->string('ifsc_code');
        //     $table->string('account_number');
        //     $table->string('account_type');
        //     $table->string('uploaded_bank_details');
        //     $table->string('uploaded_salary_statement');
        //     $table->enum('status',array('Active','Inactive'))->default('Active'); 
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_bank_details');
    }
};
