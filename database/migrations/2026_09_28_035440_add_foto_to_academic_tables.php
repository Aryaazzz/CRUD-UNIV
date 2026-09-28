<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('prodi_id');
        });

        Schema::table('dosen', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('prodi_id');
        });

        Schema::table('prodi_tabel', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('kode_prodi');
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('sks');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('prodi_tabel', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
