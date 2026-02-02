<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRateColumnInRateTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rate_tbl', function (Blueprint $table) {
            //
             if (Schema::hasColumn('rate', 'rate')) {
                $table->string('rate', 255)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rate_tbl', function (Blueprint $table) {
            //
            if (Schema::hasColumn('rate', 'rate')) {
                $table->enum('rate', ['E', 'VS', 'S', 'BS'])->change();
            }
        });
    }
}
