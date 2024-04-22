<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompletedsTable extends Migration
{
    public function up()
    {
        Schema::table('completeds', function (Blueprint $table) {
            $table->unsignedBigInteger('child_id')->nullable();
            $table->foreign('child_id', 'child_fk_9713423')->references('id')->on('children');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_9712470')->references('id')->on('tasks');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9712474')->references('id')->on('users');
        });
    }
}
