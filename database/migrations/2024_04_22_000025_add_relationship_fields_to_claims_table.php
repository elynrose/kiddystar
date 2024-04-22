<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClaimsTable extends Migration
{
    public function up()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->unsignedBigInteger('reward_id')->nullable();
            $table->foreign('reward_id', 'reward_fk_9694736')->references('id')->on('rewards');
            $table->unsignedBigInteger('card_id')->nullable();
            $table->foreign('card_id', 'card_fk_9694730')->references('id')->on('cards');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9694735')->references('id')->on('users');
        });
    }
}
