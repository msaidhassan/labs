<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::table('posts', function (Blueprint $table) {
            // Drop the existing `posted_by` column
            $table->dropColumn('posted_by');
        });

        Schema::table('posts', function (Blueprint $table) {
            // Recreate the `posted_by` column with the foreign key constraint
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
        });

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::table('posts', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['posted_by']);
            // Drop the `posted_by` column
            $table->dropColumn('posted_by');
        });

        Schema::table('posts', function (Blueprint $table) {
            // Recreate the `posted_by` column without the foreign key constraint
            $table->string('posted_by');
        });

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};