<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHelpdeskNoToTicketTbl extends Migration
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
             $table->string('helpdesk_no')
                  ->after('ticket_category_id');
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
              $table->dropColumn('helpdesk_no');
        });
    }
}
