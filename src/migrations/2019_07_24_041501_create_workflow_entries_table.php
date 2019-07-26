<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('week_id');
            $table->unsignedBigInteger('task_id');
            $table->date('date');
            $table->float('time');
            $table->timestamps();

            $table->index(['week_id', 'date']);

            $table->foreign('week_id')
                ->references('id')
                ->on('workflow_weeks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('task_id')
                ->references('id')
                ->on('workflow_tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflow_entries');
    }
}
