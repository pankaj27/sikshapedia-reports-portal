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
        // Schema::create('general_settings', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('site_title')->default(null);
        //     $table->string('site_name')->default(null);
        //     $table->string('site_favicon')->default(null);
        //     $table->string('site_main_logo')->default(null);
        //     $table->string('site_main_logo_white')->default(null);
        //     $table->string('site_address')->default(null);
        //     $table->string('site_email')->default(null);
        //     $table->string('site_email_for_admission')->default(null);
        //     $table->string('site_email_for_contact')->default(null);
        //     $table->string('site_mobile')->default(null);
        //     $table->string('site_whatsapp')->default(null);
        //     $table->string('site_mobile_for_admission')->default(null);
        //     $table->string('site_mobile_for_contact')->default(null);
        //     $table->string('site_mobile_for_office')->default(null);
        //     $table->string('site_iframe_location')->default(null);
        //     $table->text('site_social_media')->default(null);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('general_settings');
    }
};
