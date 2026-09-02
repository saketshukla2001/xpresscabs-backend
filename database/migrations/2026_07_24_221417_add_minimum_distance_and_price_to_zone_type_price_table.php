<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimumDistanceAndPriceToZoneTypePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zone_type_price', function (Blueprint $table) {
            $table->double('minimum_distance', 10, 2)->default(0)->after('base_distance');
            $table->double('minimum_price', 10, 2)->default(0)->after('minimum_distance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zone_type_price', function (Blueprint $table) {
            $table->dropColumn(['minimum_distance', 'minimum_price']);
        });
    }
}
