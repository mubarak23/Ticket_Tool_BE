<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action__tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('case_id');
            $table->string('user_id');
            $table->longText('issue');
            $table->string('issue_type');
            $table->string('assign_to');
            $table->string('submitted_by');
            $table->longText('actions');
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
        Schema::dropIfExists('action__tickets');
    }
}
