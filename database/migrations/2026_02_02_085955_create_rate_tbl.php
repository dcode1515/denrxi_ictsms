<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_tbl', function (Blueprint $table) {
           $table->id(); // Primary key
            $table->unsignedBigInteger('ticket_id')->comment('Reference to ticket_tbl'); // Foreign key reference

            // Rate: E, VS, S, BS
            $table->enum('rate', ['E', 'VS', 'S', 'BS'])
                  ->comment('User rating: E-Excellent, VS-Very Satisfactory, S-Satisfactory, BS-Below Satisfactory');

            // Feedback remarks: long text
            $table->longText('feedback_remarks')->nullable()->comment('User feedback remarks');

            // Date feedback: datetime
            $table->dateTime('date_feedback')->useCurrent()->comment('Date and time feedback was submitted');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_tbl');
    }
}
