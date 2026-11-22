<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // name, nis, classroom_id, status default 'Active', address nullable
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nis');
            // FK ke classrooms
            $table->foreignId('classroom_id')->constrained(
                table: 'classrooms', indexName: 'students_classroom_id'
            );
            $table->string('status')->default('Active');
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Hapus tabel, FK ikut hilang
        Schema::dropIfExists('students');
    }
};
