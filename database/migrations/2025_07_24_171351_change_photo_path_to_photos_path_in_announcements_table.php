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
        Schema::table('announcements', function (Blueprint $table) {
            // Drop the old column if it exists
            if (Schema::hasColumn('announcements', 'photo_path')) {
                $table->dropColumn('photo_path');
            }
            // Add the new column as JSON
            $table->json('photos_path')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Drop the new column if it exists
            if (Schema::hasColumn('announcements', 'photos_path')) {
                $table->dropColumn('photos_path');
            }
            // Re-add the old column if needed for rollback
            $table->string('photo_path')->nullable()->after('content');
        });
    }
};