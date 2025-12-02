<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('name'); // nama syarat, misal: "KTM", "Surat Delegasi"
            $table->text('description')->nullable();
            $table->enum('type', ['text', 'file', 'link']); // tipe inputan
            $table->boolean('is_required')->default(true);
            $table->integer('order')->default(0); // urutan tampil
            $table->timestamps();
            
            $table->index('event_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_requirements');
    }
};