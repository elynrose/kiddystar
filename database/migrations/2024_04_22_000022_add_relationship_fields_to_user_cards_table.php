<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserCardsTable extends Migration
{
    public function up()
    {
        Schema::table('user_cards', function (Blueprint $table) {
            $table->unsignedBigInteger('card_id')->nullable();
            $table->foreign('card_id', 'card_fk_9694703')->references('id')->on('cards');
            $table->unsignedBigInteger('children_id')->nullable();
            $table->foreign('children_id', 'children_fk_9695334')->references('id')->on('children');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9694708')->references('id')->on('users');
        });
    }
}
