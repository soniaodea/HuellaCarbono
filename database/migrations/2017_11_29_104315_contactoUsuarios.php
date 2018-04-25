<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactoUsuarios extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contactoUsuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->string('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contactoUsuarios');
    }
}
