<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatIngresoInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adq_cat_ingreso_invs', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 10)->unique();
            $table->integer('cantidadnuevo');
            $table->decimal('pesonuevo',        $precision = 15, $scale = 2)->nullable();
            $table->string('estatus', 10);
            $table->decimal('costonuevo',       $precision = 15, $scale = 2)->nullable();
            $table->decimal('costokilonuevo',   $precision = 15, $scale = 2)->nullable();
            $table->decimal('precionuevo',      $precision = 15, $scale = 2)->nullable();
            $table->integer('idcatarticulos');
            $table->integer('idunidadtipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_ingreso_invs');
    }
}
