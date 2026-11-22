<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom tanggal mulai mengajar
        Schema::table('teachers', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('subject_id');
        });

        $teachers = DB::table('teachers')->orderBy('id')->get(['id', 'created_at']);

        // NIP 10 digit berurutan + start_date dari created_at
        foreach ($teachers as $index => $teacher) {
            DB::table('teachers')->where('id', $teacher->id)->update([
                'nip' => (string) (1980000001 + $index),
                'start_date' => $teacher->created_at
                    ? substr($teacher->created_at, 0, 10)
                    : now()->toDateString(),
            ]);
        }

        // nip jadi angka, start_date jadi NOT NULL
        Schema::table('teachers', function (Blueprint $table) {
            $table->bigInteger('nip')->change();
            $table->date('start_date')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        // Balikkan tipe nip & drop start_date
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('nip')->change();
            $table->dropColumn('start_date');
        });
    }
};
