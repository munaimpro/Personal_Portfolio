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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_heading');
            $table->string('post_slug');
            $table->string('post_thumbnail', 100);
            $table->longText('post_descrption');
            $table->integer('post_view')->default(0);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('publish_time');
            $table->enum('post_status', ['published', 'unpublished']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
