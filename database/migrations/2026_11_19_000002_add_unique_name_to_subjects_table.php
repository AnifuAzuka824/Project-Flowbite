<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cegah nama mapel duplikat
        Schema::table('subjects', function (Blueprint $table) {
            $table->unique('name', 'subjects_name_unique');
        });
    }

    public function down(): void
    {
        // Lepas unique index
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropUnique('subjects_name_unique');
        });
    }
};
