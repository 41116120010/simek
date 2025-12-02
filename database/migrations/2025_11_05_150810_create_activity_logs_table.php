<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('log_name')->nullable(); // kategori log
            $table->text('description');
            $table->string('subject_type')->nullable(); // model yang diubah
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('event')->nullable(); // created, updated, deleted
            $table->json('properties')->nullable(); // old & new values
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('subject_type');
            $table->index('subject_id');
            $table->index('log_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};