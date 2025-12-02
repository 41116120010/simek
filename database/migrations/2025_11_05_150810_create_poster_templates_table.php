<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poster_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('thumbnail'); // preview template
            $table->string('file_path'); // path ke file template
            $table->json('text_positions')->nullable(); // posisi text di template (x, y, size, color)
            $table->enum('category', ['competition', 'seminar', 'general'])->default('general');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poster_templates');
    }
};