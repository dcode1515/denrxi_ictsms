<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketCategoryTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_category_tbl', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('ticket_type_id');
            $table->string('ticket_category');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key constraint
            $table->foreign('ticket_type_id')
                  ->references('id')
                  ->on('ticket_type_tbl')
                  ->onDelete('cascade');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('ticket_category_tbl');
    }
}
