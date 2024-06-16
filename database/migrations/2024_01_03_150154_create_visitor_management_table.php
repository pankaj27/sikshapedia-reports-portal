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
        Schema::create('visitor_management', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('organization_name')->default(null);
            $table->string('contact_person_name')->default(null);
            $table->string('contact_person_designation')->default(null);
            $table->string('contact_person_mobile')->default(null);
            $table->string('organization_mobile')->default(null);
            $table->string('organization_email')->default(null);
            $table->string('organization_address')->default(null);
            $table->string('organization_district')->default(null);
            $table->string('organization_state')->default(null);
            $table->integer('organization_pincode')->default(null);
            $table->date('agent_visiting_date')->default(null);
            $table->date('next_followup_date')->default(null);
            $table->text('remarks')->default(null);
            $table->enum('visit_status',array("Positive","Very Interested","Asked to Visit Again","Actual Person absent"))->default(null);
            $table->integer('status')->default(1);
            $table->integer('agent_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_management');
    }
};
