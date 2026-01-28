<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToTicketTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_tbl', function (Blueprint $table) {
            //
              $table->string('token', 255)
                  ->nullable()
                  ->unique()
                  ->after('status'); // adjust column position if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_tbl', function (Blueprint $table) {
            //
            $table->dropUnique(['token']);
            $table->dropColumn('token');
        });
    }
}
