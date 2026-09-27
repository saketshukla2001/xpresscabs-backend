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
        if (!Schema::hasTable('requests')) {
            return;
        }

        Schema::table('requests', function (Blueprint $table) {
            if (!Schema::hasColumn('requests', 'drivers_sent_count')) {
                $table->unsignedInteger('drivers_sent_count')->default(0);
            }
            if (!Schema::hasColumn('requests', 'drivers_rang_count')) {
                $table->unsignedInteger('drivers_rang_count')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('requests')) {
            return;
        }

        Schema::table('requests', function (Blueprint $table) {
            if (Schema::hasColumn('requests', 'drivers_sent_count')) {
                $table->dropColumn('drivers_sent_count');
            }
            if (Schema::hasColumn('requests', 'drivers_rang_count')) {
                $table->dropColumn('drivers_rang_count');
            }
        });
    }
};
