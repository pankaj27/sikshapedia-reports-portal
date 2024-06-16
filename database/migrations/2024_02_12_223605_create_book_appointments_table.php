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
        Schema::create('book_appointments', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('organization_name')->default(null);
            $table->string('contact_person_name')->default(null);
            $table->string('contact_person_mobile')->default(null);
            $table->string('contact_person_mobile2')->default(null);
            $table->string('organization_address')->default(null);
            $table->date('appointment_date')->default(null);
            $table->timestamp('appointment_timing')->default(null);
            $table->text('remarks')->default(null);
            $table->enum('visit_status',array("Appointment-Visit","Appointment-Revisit","Not-Interested"))->default(null);
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
        Schema::dropIfExists('book_appointments');
    }
};
