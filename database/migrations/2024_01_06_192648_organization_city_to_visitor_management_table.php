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
        Schema::table('visitor_management', function (Blueprint $table) {
            $table->string('organization_city')->default(null)->after('organization_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_management', function (Blueprint $table) {
            $table->dropColumn('organization_city');

        });
    }
};
