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
        Schema::create('college', function (Blueprint $table) {
            $table->id();
            $table->integer('college_code');
            $table->text('college_full_name');
            $table->string('college_username');
            $table->text('college_address');
            $table->string('college_principal');
            $table->string('contact_email');
            $table->string('contact_mobile');
            $table->string('college_alias');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_full_affiliated')->default(1);
            $table->integer('graduate_list_order')->default(null);             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college');
    }
};
