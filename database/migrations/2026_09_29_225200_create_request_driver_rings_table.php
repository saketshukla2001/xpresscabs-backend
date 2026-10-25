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
        if (Schema::hasTable('request_driver_rings')) {
            return;
        }

        Schema::create('request_driver_rings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('request_id');
            $table->unsignedInteger('driver_id');
            $table->timestamps();

            $table->index('request_id');
            $table->index('driver_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_driver_rings');
    }
};
