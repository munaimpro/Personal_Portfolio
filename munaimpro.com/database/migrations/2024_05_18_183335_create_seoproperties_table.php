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
            // Primary key
            $table->id();
        
            // Page Information
            $table->enum('page_name', [
                'index', 'about', 'services', 'portfolio', 
                'portfolio_details', 'pricing', 'blog', 
                'blog_details', 'contact'
            ]);
        
            // General SEO Information
            $table->string('site_title', 50);
            $table->string('site_keywords');
            $table->tinyText('site_description');
            $table->string('author', 100);
        
            // Open Graph Meta Tags
            $table->string('og_site_name', 100);
            $table->string('og_url', 100);
            $table->string('og_title', 100);
            $table->tinyText('og_description');
            $table->enum('og_type', [
                'website', 'article', 'video.movie', 
                'video.episode', 'video.tv_show', 
                'video.other', 'music.song', 
                'music.album', 'profile', 'product'
            ]);
            $table->string('og_image', 100);
        
            // Twitter Card Meta Tags
            $table->enum('twitter_card', [
                'summary', 'summary_large_image', 
                'app', 'player'
            ]);
            $table->string('twitter_title', 100);
            $table->tinyText('twitter_description');
            $table->string('twitter_image', 100);
        
            // Robots Meta Tag
            $table->enum('robots', [
                'index, follow', 'noindex, follow', 
                'index, nofollow', 'noindex, nofollow', 
                'noarchive', 'nosnippet', 'noodp', 
                'noimageindex', 'nocache'
            ]);
        
            // Additional Meta Tags
            $table->string('canonical_url', 100);
            $table->string('application_name', 100);
            $table->string('theme_color', 100);
            $table->string('google_site_verification', 100)->nullable();
            $table->enum('referrer', [
                'no-referrer', 'no-referrer-when-downgrade', 
                'origin', 'origin-when-cross-origin', 
                'same-origin', 'strict-origin', 
                'strict-origin-when-cross-origin', 'unsafe-url'
            ]);
        
            // Timestamps
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
