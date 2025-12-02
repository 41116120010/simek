<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique(); // kode registrasi unik
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ketua tim atau peserta
            
            // Untuk lomba tim
            $table->string('team_name')->nullable();
            
            // Data tambahan
            $table->json('requirement_answers')->nullable(); // jawaban syarat & ketentuan
            $table->text('notes')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'waiting_payment', 'paid', 'confirmed', 'attended', 'cancelled'])->default('pending');
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('attended_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('event_id');
            $table->index('user_id');
            $table->index('status');
            $table->unique(['event_id', 'user_id']); // 1 user 1 event
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};