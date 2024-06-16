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
        // Schema::create('onboarding_personal_details', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('candidate_name');
        //     $table->string('fathers_name');
        //     $table->string('mothers_name');
        //     $table->date('dob');
        //     $table->string('place_of_birth');
        //     $table->enum('gender',array('Male','Female','Others'))->default(null);
        //     $table->enum('blood_group',array('A+','A-','B+','B-','AB+','AB-','O+','O-'))->default(null);
        //     $table->enum('martial_status',array('Married','Not Married','Separation'))->default(null);
        //     $table->string('spouce_name')->default(null);
        //     $table->enum('natiolity',array('Indian'))->default('Indian');
        //     $table->enum('religion',array('Hinduism','Islam','Christianity','Sikhism','Buddhism','Jains'))->default(null);
        //     $table->string('present_house_no');
        //     $table->string('present_locality_name');
        //     $table->string('present_post_office');
        //     $table->string('present_land_mark');
        //     $table->string('present_state');
        //     $table->string('present_district');
        //     $table->string('present_city');
        //     $table->string('present_pincode');
        //     $table->string('present_policestation');
        //     $table->string('permanent_house_no');
        //     $table->string('permanent_locality_name');
        //     $table->string('permanent_post_office');
        //     $table->string('permanent_land_mark');
        //     $table->string('permanent_state');
        //     $table->string('permanent_district');
        //     $table->string('permanent_city');
        //     $table->string('permanent_pincode');
        //     $table->string('permanent_policestation');
        //     $table->string('pan_number');
        //     $table->string('adhaar_number');
        //     $table->string('mobile_number');
        //     $table->string('email_id');
        //     $table->string('emergency_contact');
        //     $table->string('parent_spouce_contact');
        //     $table->string('reference_person_name');
        //     $table->string('reference_contact_no');
        //     $table->string('uploaded_pan_card');
        //     $table->string('uploaded_adhaar_card');
        //     $table->string('uploaded_photo');
        //     $table->enum('status',array('Active','Inactive'))->default('Active');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_personal_details');
    }
};
