<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel master jurusan, code & name unik
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Kolom FK sementara di classrooms & subjects
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->after('name');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->after('code');
        });

        // Kumpulkan nama jurusan lama tanpa duplikat
        $majorNames = DB::table('classrooms')->distinct()->pluck('major')
            ->merge(DB::table('subjects')->distinct()->pluck('major'))
            ->filter()
            ->unique();

        // Satu baris per jurusan
        foreach ($majorNames as $name) {
            DB::table('majors')->insert([
                'code' => $this->codeFromName($name),
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $majorIds = DB::table('majors')->pluck('id', 'name');

        // Cocokkan major_id dari nama jurusan yang sama
        foreach (DB::table('classrooms')->get(['id', 'major']) as $classroom) {
            DB::table('classrooms')->where('id', $classroom->id)->update([
                'major_id' => $majorIds[$classroom->major],
            ]);
        }

        foreach (DB::table('subjects')->get(['id', 'major']) as $subject) {
            DB::table('subjects')->where('id', $subject->id)->update([
                'major_id' => $majorIds[$subject->major],
            ]);
        }

        // Wajib terisi; jurusan tidak bisa dihapus saat dipakai
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable(false)->change();
            $table->foreign('major_id')->references('id')->on('majors')->restrictOnDelete();
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable(false)->change();
            $table->foreign('major_id')->references('id')->on('majors')->restrictOnDelete();
        });

        // Hapus kolom string lama, normalisasi selesai
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropColumn('major');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('major');
        });

        // Relasi kelas→guru; guru dihapus, kelas tetap ada
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->after('major_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Balikkan semua: pulihkan kolom major, drop FK/kolom, drop majors
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->string('major')->nullable()->after('name');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->string('major')->nullable()->after('code');
        });

        $majorNames = DB::table('majors')->pluck('name', 'id');

        foreach (DB::table('classrooms')->get(['id', 'major_id']) as $classroom) {
            DB::table('classrooms')->where('id', $classroom->id)->update([
                'major' => $majorNames[$classroom->major_id],
            ]);
        }

        foreach (DB::table('subjects')->get(['id', 'major_id']) as $subject) {
            DB::table('subjects')->where('id', $subject->id)->update([
                'major' => $majorNames[$subject->major_id],
            ]);
        }

        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropColumn('major_id');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('major_id');
        });

        Schema::dropIfExists('majors');
    }

    // Ambil kode dalam kurung "(RPL)"; fallback 3 huruf awal
    private function codeFromName(string $name): string
    {
        if (preg_match('/\(([^)]+)\)/', $name, $matches)) {
            return $matches[1];
        }

        return strtoupper(substr($name, 0, 3));
    }
};
