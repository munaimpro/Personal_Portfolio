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
        Schema::create('seoproperties', function (Blueprint $table) {
            $table->id();
            $table->enum('page_name', ['index','about','services','portfolio','portfolio_details','pricing','blog','blog_details','contact']);
            $table->string('site_title', 50);
            $table->string('site_keywords');
            $table->tinyText('site_description');
            $table->string('og_site_name', 100);
            $table->string('og_url', 100);
            $table->string('og_title', 100);
            $table->text('og_description');
            $table->string('og_image', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seoproperties');
    }
};
