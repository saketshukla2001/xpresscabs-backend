<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeZoneSurgePricesValueToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('zone_surge_prices') && Schema::hasColumn('zone_surge_prices', 'value')) {
            DB::statement("ALTER TABLE zone_surge_prices MODIFY value DECIMAL(8,2) NOT NULL COMMENT 'In percentage'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('zone_surge_prices') && Schema::hasColumn('zone_surge_prices', 'value')) {
            DB::statement("ALTER TABLE zone_surge_prices MODIFY value INT NOT NULL COMMENT 'In percentage'");
        }
    }
}
