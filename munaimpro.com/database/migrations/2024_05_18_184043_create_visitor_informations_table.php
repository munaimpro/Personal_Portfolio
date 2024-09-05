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
        Schema::create('visitor_informations', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 100);
            $table->string('visitor_country', 100);
            $table->string('visitor_city', 100);
            $table->string('visitor_device_type', 100);
            $table->string('visitor_operating_system', 100);
            $table->string('visitor_browser', 100);
            $table->string('visitor_screen_resolution', 50);
            $table->integer('total_visit')->default(0);
            $table->timestamp('last_visiting_time');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_informations');
    }
};
