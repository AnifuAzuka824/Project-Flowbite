<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kunci di level DB: 1 mapel hanya 1 guru (OneToOne)
        Schema::table('teachers', function (Blueprint $table) {
            $table->unique('subject_id', 'teachers_subject_id_unique');
        });
    }

    public function down(): void
    {
        // Lepas unique index
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropUnique('teachers_subject_id_unique');
        });
    }
};
