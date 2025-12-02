<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // kode event unik
            $table->enum('type', ['competition', 'seminar']); // lomba atau seminar
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('terms_conditions')->nullable(); // syarat & ketentuan umum
            
            // Untuk lomba
            $table->enum('competition_type', ['individual', 'team', 'both'])->nullable();
            $table->integer('max_team_members')->nullable(); // max anggota tim
            $table->integer('min_team_members')->nullable(); // min anggota tim
            
            // Untuk seminar
            $table->string('speaker_name')->nullable();
            $table->text('speaker_bio')->nullable();
            $table->string('speaker_photo')->nullable();
            
            // Lokasi & Waktu
            $table->string('venue'); // tempat
            $table->string('venue_address')->nullable();
            $table->string('venue_link')->nullable(); // gmaps link
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            
            // Kapasitas & Biaya
            $table->integer('quota')->nullable(); // batas peserta (null = unlimited)
            $table->integer('registered_count')->default(0); // jumlah terdaftar
            $table->decimal('registration_fee', 10, 2)->default(0); // biaya pendaftaran
            $table->boolean('is_free')->default(false);
            
            // Pendaftaran
            $table->dateTime('registration_start');
            $table->dateTime('registration_end');
            
            // Media
            $table->string('banner')->nullable(); // banner event
            $table->string('poster')->nullable(); // poster generated
            
            // Status
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft');
            
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('type');
            $table->index('status');
            $table->index(['start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};