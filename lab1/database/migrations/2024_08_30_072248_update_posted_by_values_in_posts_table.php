<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update `posted_by` values to a random number between 1 and 10
        DB::table('posts')
            ->where('posted_by', 0)
            ->update([
                'posted_by' => DB::raw('FLOOR(1 + RAND() * 10)')
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the changes if needed
        DB::table('posts')
            ->whereBetween('posted_by', [1, 10])
            ->update(['posted_by' => 0]);
    }
};