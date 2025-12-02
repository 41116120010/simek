<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('institution')->nullable();
            $table->string('student_id')->nullable(); // NIM/NIS
            $table->enum('role', ['leader', 'member'])->default('member');
            $table->timestamps();
            
            $table->index('registration_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_members');
    }
};