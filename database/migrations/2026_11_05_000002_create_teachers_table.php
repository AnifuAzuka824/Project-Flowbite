<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // name, nip unik, subject_id, phone/address nullable
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip')->unique();
            // FK ke subjects
            $table->foreignId('subject_id')->constrained(
                table: 'subjects', indexName: 'teachers_subject_id'
            );
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Hapus tabel teachers
        Schema::dropIfExists('teachers');
    }
};
