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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('project_title');
            $table->string('project_thumbnail', 100);
            $table->json('project_ui_image');
            $table->string('project_type', 100);
            $table->foreignId('service_id')->constrained();
            $table->text('project_description');
            $table->string('client_name', 100);
            $table->string('client_designation', 100)->nullable();
            $table->date('project_starting_date');
            $table->date('project_ending_date');
            $table->string('project_url', 100);
            $table->string('core_technology', 100);
            $table->integer('project_view')->default(0);
            $table->enum('project_status', ['published', 'unpublished']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
