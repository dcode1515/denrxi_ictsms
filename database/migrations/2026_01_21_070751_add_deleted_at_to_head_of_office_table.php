<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToHeadOfOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_office_tbl', function (Blueprint $table) {
            //
             $table->softDeletes(); // adds deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('head_office_tbl', function (Blueprint $table) {
            //
             $table->dropSoftDeletes(); // removes deleted_at column
        });
    }
}
