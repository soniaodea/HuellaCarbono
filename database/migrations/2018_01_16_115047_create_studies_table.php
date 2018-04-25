<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('year');
            $table->unique(['building_id', 'year']);
            $table->string('carbon_footprint')->nullable();
            $table->string('a1_gas_natural_kwh')->nullable();
            $table->string('a1_gas_natural_nm3')->nullable();
            $table->string('a1_refrigerantes')->nullable();
            $table->string('a1_recarga_gases_refrigerantes')->nullable();
            $table->string('a2_electricidad_kwh')->nullable();
            $table->string('a3_agua_potable_m3')->nullable();
            $table->string('a3_papel_carton_consumo_kg')->nullable();
            $table->string('a3_papel_carton_residuos_kg')->nullable();
            $table->string('a3_factor_kwh_nm3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('studies');
    }
}
