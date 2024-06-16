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
        // Schema::create('onboarding_step_forms', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->unsignedBigInteger('applicant_id');
        //     $table->foreign('applicant_id')->references('id')->on('onboarding_personal_details')->onDelete('cascade');
        //     $table->integer('personal_details')->default(0);
        //     $table->integer('education_details')->default(0);
        //     $table->integer('past_employment_details')->default(0); 
        //     $table->integer('bank_details')->default(0);   
        //     $table->integer('acknowledgement_details')->default(0);    
        //     $table->enum('status',array('Active','Inactive'))->default('Active');        
        //     $table->enum('is_final_submit',array('0','1'))->default('0'); 
        //     $table->timestamps();

        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_step_forms');
    }
};
