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
        Schema::table('achievements', function (Blueprint $table) {
            // Add new columns
            $table->string('nama')->after('user_id');
            $table->string('nama_kompetisi')->after('nama');
            $table->string('tingkat_kompetisi')->after('nama_kompetisi');
            $table->string('penyelenggara')->after('tingkat_kompetisi');
            $table->string('prestasi')->after('penyelenggara');
            $table->date('tanggal_pelaksanaan')->after('prestasi');
            $table->string('dosen_pembimbing')->nullable()->after('tanggal_pelaksanaan');
            $table->text('keterangan_lomba')->nullable()->after('dosen_pembimbing');
            $table->string('file_sertifikat')->nullable()->after('keterangan_lomba');

            // Drop old columns
            $table->dropColumn(['semester', 'class', 'title', 'description', 'file_path', 'photo_path', 'is_accepted']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            // Re-add old columns (for rollback purposes)
            $table->string('semester')->nullable();
            $table->string('class')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('is_accepted')->default(false);

            // Drop new columns
            $table->dropColumn([
                'nama',
                'nama_kompetisi',
                'tingkat_kompetisi',
                'penyelenggara',
                'prestasi',
                'tanggal_pelaksanaan',
                'dosen_pembimbing',
                'keterangan_lomba',
                'file_sertifikat',
            ]);
        });
    }
};