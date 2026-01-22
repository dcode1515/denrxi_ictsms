<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
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
              $table->string('contact_number')->after('email');
            $table->string('position')->nullable()->after('contact_number');

            $table->foreignId('head_office_id')
                  ->nullable()
                  ->constrained('head_office_tbl')
                  ->nullOnDelete()
                  ->after('position');

            $table->foreignId('office_id')
                  ->nullable()
                  ->constrained('office_tbl')
                  ->nullOnDelete()
                  ->after('head_office_id');

            $table->boolean('agree_and_terms_condition')
                  ->default(false)
                  ->after('office_id');

            $table->boolean('information_confirmed')
                  ->default(false)
                  ->after('agree_and_terms_condition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'contact_number',
                'position',
                'head_office_id',
                'office_id',
                'agree_and_terms_condition',
                'information_confirmed',
            ]);
        });
    }
}
