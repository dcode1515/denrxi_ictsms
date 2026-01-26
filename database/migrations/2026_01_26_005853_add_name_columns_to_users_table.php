<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
             $table->string('firstname')->nullable()->after('name');
            $table->string('middle_initial', 10)->nullable()->after('firstname');
            $table->string('lastname')->nullable()->after('middle_initial');
            $table->string('extension', 10)->nullable()->after('lastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn([
                'firstname',
                'middle_initial',
                'lastname',
                'extension',
            ]);
    }
}
