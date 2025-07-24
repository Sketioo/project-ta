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
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'kode_dokumen')) {
                $table->string('kode_dokumen')->nullable()->after('title');
            }
            if (!Schema::hasColumn('documents', 'document_category_id')) {
                $table->foreignId('document_category_id')->nullable()->after('kode_dokumen')->constrained('document_categories')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'document_category_id')) {
                $table->dropForeign(['document_category_id']);
                $table->dropColumn('document_category_id');
            }
            if (Schema::hasColumn('documents', 'kode_dokumen')) {
                $table->dropColumn('kode_dokumen');
            }
        });
    }
};