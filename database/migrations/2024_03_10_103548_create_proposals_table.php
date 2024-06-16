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
        // Schema::create('proposals', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->unsignedBigInteger('institute_id');
        //     $table->foreign('institute_id')->references('id')->on('call_registers')->onDelete('cascade');
        //     $table->string('contact_person');
        //     $table->string('mobile_number');
        //     $table->string('email_address');
        //     $table->text('communicaton_address');
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        //     $table->unsignedBigInteger('payment_id');
        //     $table->foreign('payment_id')->references('id')->on('product_cost')->onDelete('cascade');
        //     $table->decimal('product_cost');
        //     $table->decimal('product_gst');
        //     $table->decimal('product_discount')->default(0);
        //     $table->decimal('product_total_cost');
        //     $table->date('proposal_valid_upto');
        //     $table->integer('proposal_email_sent')->default(0);
        //     $table->integer('email_sent_by')->default(null);
        //     $table->integer('status')->default(1);
        //     $table->string('proposal_file')->default(1);  
        //     $table->text('proposal_message_body');    

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
