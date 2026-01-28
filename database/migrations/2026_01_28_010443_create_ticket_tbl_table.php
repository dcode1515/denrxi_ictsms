<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_tbl', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ticket_type_id');
            $table->unsignedBigInteger('ticket_category_id');

            $table->string('property_number')->nullable();

            $table->dateTime('date_created');

            $table->string('firstname');
            $table->string('middle_initial', 5)->nullable();
            $table->string('lastname');
            $table->string('extension', 10)->nullable();

            $table->string('email');
            $table->string('position')->nullable();

            $table->unsignedBigInteger('head_office_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();

            $table->longText('issue_concern');

            // store uploaded file path or filename
            // can also be json() if multiple attachments
            $table->string('attachment')->nullable();

            $table->string('status')->nullable();

            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_tbl');
    }
}
