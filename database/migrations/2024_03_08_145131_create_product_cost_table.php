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
        // Schema::create('product_cost', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('product_id');
        //     $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        //     $table->enum('product_cost_type',array('ONE-TIME','INSTALLMENT'))->default('ONE-TIME');
        //     $table->integer('product_installment_number')->default(0);
        //     $table->decimal('product_cost')->length(11,2);
        //     $table->decimal('product_discount')->length(11,2);
        //     $table->longText('product_installment_terms')->default(null);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_cost');
    }
};
