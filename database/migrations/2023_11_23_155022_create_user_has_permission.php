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
        Schema::create('user_has_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('modules_id');
            $table->text('route_url');
            $table->enum('can_view',['Yes','No'])->default('No');
            $table->enum('can_list',['Yes','No'])->default('No');
            $table->enum('can_create',['Yes','No'])->default('No');
            $table->enum('can_edit',['Yes','No'])->default('No');
            $table->enum('can_update',['Yes','No'])->default('No');
            $table->enum('can_delete',['Yes','No'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_permission');
    }
};
