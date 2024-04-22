<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCardBatchesTable extends Migration
{
    public function up()
    {
        Schema::table('card_batches', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('business_id', 'business_fk_9694695')->references('id')->on('users');
        });
    }
}
