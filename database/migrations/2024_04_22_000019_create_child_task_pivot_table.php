<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildTaskPivotTable extends Migration
{
    public function up()
    {
        Schema::create('child_task', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id', 'task_id_fk_9698782')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('child_id');
            $table->foreign('child_id', 'child_id_fk_9698782')->references('id')->on('children')->onDelete('cascade');
        });
    }
}
