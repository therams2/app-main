<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdqCatArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adq_cat_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('nombre', 100);
            $table->string('descripcion', 200);
            $table->float('precio')->default(0);
            $table->float('costo_ini')->default(0);
            $table->integer('cantidad')->default(0);
            $table->integer('id_categoria')->default(-1);
            $table->integer('id_unidad_medida')->default(-1);
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
        Schema::dropIfExists('adq_cat_articulos');
    }
}
