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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('year', 10);
            $table->string('category'); // Web Application, UI/UX Design, System & POS, Mobile App
            $table->string('client_or_context');
            $table->string('thumbnail_url');
            $table->text('summary');
            $table->text('case_study');
            $table->json('tech_stack');
            $table->string('live_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

