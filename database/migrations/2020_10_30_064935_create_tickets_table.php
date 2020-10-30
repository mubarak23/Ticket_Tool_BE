<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('case_id');
            $table->strinng('user_id');
            $table->string('agent_name');
            $table->string('agent_email');
            $table->string('agent_phone');
            $table->string('terminal_id');
            $table->longText('issue')->default('Ticket Issue Raise');
            $table->string('RRN')->default('RRN');
            $table->string('issue_type');
            $table->string('reference_id');
            $table->string('comment')->default('Ticket General Comment');
            $table->string('amount')->nullable();
            $table->string('assign_to');
            $table->string('assign_to_email');
            $table->string('status')->default('Ticket Created');
            $table->string('submitted_by');
            $table->string('close_issue_status')->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
