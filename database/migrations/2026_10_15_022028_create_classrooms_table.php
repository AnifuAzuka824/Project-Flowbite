<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // id, name, major (masih string, nanti dinormalisasi)
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('major');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Hapus tabel classrooms
        Schema::dropIfExists('classrooms');
    }
};
