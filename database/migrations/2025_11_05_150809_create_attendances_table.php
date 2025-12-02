<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_session_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('check_in_at')->nullable();
            $table->string('check_in_by')->nullable(); // siapa yang konfirmasi
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('registration_id');
            $table->index('event_session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};