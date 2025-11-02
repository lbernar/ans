<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
            $table->index('level');
            $table->index('status');
        });

        // Add indexes to questions table
        Schema::table('questions', function (Blueprint $table) {
            $table->index('quest_id');
            $table->index('type');
        });

        // Add indexes to answers table
        Schema::table('answers', function (Blueprint $table) {
            $table->index('quest_id');
            $table->index('resp_id');
        });

        // Add indexes to results table
        Schema::table('results', function (Blueprint $table) {
            $table->index('quest_id');
            $table->index('resp_id');
        });

        // Convert users status from char to boolean-like tinyint
        // SQLite doesn't support ALTER COLUMN directly, so we handle it with raw SQL
        if (DB::connection()->getDriverName() === 'sqlite') {
            // For SQLite, we keep the char but ensure values are consistent
            DB::statement("UPDATE users SET status = '1' WHERE status != '0'");
        } else {
            // For MySQL/PostgreSQL, we can alter the column
            DB::statement("ALTER TABLE users MODIFY status TINYINT(1) DEFAULT 1");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['level']);
            $table->dropIndex(['status']);
        });

        // Drop indexes from questions table
        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex(['quest_id']);
            $table->dropIndex(['type']);
        });

        // Drop indexes from answers table
        Schema::table('answers', function (Blueprint $table) {
            $table->dropIndex(['quest_id']);
            $table->dropIndex(['resp_id']);
        });

        // Drop indexes from results table
        Schema::table('results', function (Blueprint $table) {
            $table->dropIndex(['quest_id']);
            $table->dropIndex(['resp_id']);
        });
    }
};
