<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceiveColumnsToTicketTbl extends Migration
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
              $table->unsignedBigInteger('receive_technician_id')
                  ->nullable()
                  ->after('id'); // change column if needed

            $table->dateTime('date_receive')
                  ->nullable()
                  ->after('receive_technician_id');

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
             $table->dropColumn([
                'receive_technician_id',
                'date_receive'
            ]);
        });
    }
}
