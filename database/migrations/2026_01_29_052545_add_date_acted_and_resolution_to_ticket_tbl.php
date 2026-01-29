<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateActedAndResolutionToTicketTbl extends Migration
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
             $table->timestamp('date_acted')->nullable()->after('date_created');
            
            // Add resolution column with 255 character limit
            $table->string('resolution', 255)->nullable()->after('date_acted');
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
             $table->dropColumn(['date_acted', 'resolution']);
        });
    }
}
