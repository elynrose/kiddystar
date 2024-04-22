<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
