<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('card_batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch_code')->unique();
            $table->date('published')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('distrubuted')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
