<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('apellidos', 150);
            $table->string('telefono', 10);
            $table->string('email', 150); 
            $table->string('foto', 150)->nullable();
            $table->string('direccion', 150); 
            $table->string('funcionariop', 260); 
            $table->smallInteger('estatus');    // [1:'ROTACION', 2:'BAJA', 3:'EN ESPERA', 4:'EN FUNCION',5:'CANCELADO'] 
            $table->smallInteger('activo')->default(1);    // 0 usuario inactivo 1 usuario activo
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
        Schema::dropIfExists('cat_funcionarios');
    }
}
