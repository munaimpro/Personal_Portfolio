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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('greetings', 100);
            $table->string('full_name', 100);
            $table->string('designation', 100);
            $table->string('hero_description');
            $table->string('hero_image', 100);
            $table->text('about_description');
            $table->string('about_image', 100);
            $table->string('resume_link', 100);
            $table->string('email', 50);
            $table->string('phone', 15);
            $table->string('location', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
