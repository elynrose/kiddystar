<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCardsTable extends Migration
{
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('card_batch_id')->nullable();
            $table->foreign('card_batch_id', 'card_batch_fk_9694701')->references('id')->on('card_batches');
        });
    }
}
