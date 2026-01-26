<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_assign', function (Blueprint $table) {
            $table->id();
            $table->string('module_assign');
            $table->timestamps();
            $table->softDeletes();
            
            // Optional: Add indexes for better performance
            $table->index('module_assign');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_assign');
    }
}
