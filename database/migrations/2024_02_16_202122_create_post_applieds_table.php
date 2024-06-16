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
        // Schema::create('post_applieds', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('post_name');
        //     $table->enum('status',array('Active','Inactive'))->default(null);            
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Schema::dropIfExists('post_applieds');
    }
};
