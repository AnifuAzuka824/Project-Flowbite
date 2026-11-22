<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 10 nama jurusan untuk backfill
    private const MAJORS = [
        'Rekayasa Perangkat Lunak (RPL)',
        'Design Komunikasi Visual (DKV)',
        'Teknik Grafika (TG)',
        'Design Grafis (DG)',
        'Animasi 2D & 3D (AM)',
        'Management Layanan Bisnis Perkantoran (MLBP)',
        'Teknik Komputer Jaringan (TKJ)',
        'Teknik Elektronika Audio Video (TAV)',
        'Desain Pemodelan dan Informasi Bangunan (DPIB)',
        'Teknik Otomotif (TO)',
    ];

    public function up(): void
    {
        // Kolom sementara, belum wajib
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('major')->nullable()->after('code');
        });

        // Peta kode mapel → jurusan
        $majorByCode = [
            'PBO' => 'Rekayasa Perangkat Lunak (RPL)',
            'PWPB' => 'Rekayasa Perangkat Lunak (RPL)',
            'PPL' => 'Rekayasa Perangkat Lunak (RPL)',
            'PD' => 'Rekayasa Perangkat Lunak (RPL)',
            'BD' => 'Rekayasa Perangkat Lunak (RPL)',
            'MP' => 'Rekayasa Perangkat Lunak (RPL)',
            'UID' => 'Rekayasa Perangkat Lunak (RPL)',
            'INF' => 'Rekayasa Perangkat Lunak (RPL)',
            'KB' => 'Rekayasa Perangkat Lunak (RPL)',
            'JKD' => 'Teknik Komputer Jaringan (TKJ)',
            'AIJ' => 'Teknik Komputer Jaringan (TKJ)',
            'SK' => 'Teknik Komputer Jaringan (TKJ)',
            'IOT' => 'Teknik Komputer Jaringan (TKJ)',
            'KS' => 'Teknik Komputer Jaringan (TKJ)',
            'CC' => 'Teknik Komputer Jaringan (TKJ)',
            'DG' => 'Design Grafis (DG)',
            'PKK' => 'Management Layanan Bisnis Perkantoran (MLBP)',
            'SIM' => 'Management Layanan Bisnis Perkantoran (MLBP)',
        ];

        $majors = self::MAJORS;
        $total = count($majors);

        // Isi jurusan tiap mapel, fallback modulo bila kode tak terdaftar
        foreach (DB::table('subjects')->orderBy('id')->get() as $index => $subject) {
            $major = $majorByCode[$subject->code] ?? $majors[$index % $total];

            DB::table('subjects')->where('id', $subject->id)->update(['major' => $major]);
        }

        // Jadikan NOT NULL setelah semua terisi
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('major')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        // Drop kolom major
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('major');
        });
    }
};
