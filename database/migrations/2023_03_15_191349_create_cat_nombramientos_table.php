<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatNombramientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_nombramientos', function (Blueprint $table) {
            $table->id();
            $table->string('observaciones', 260);
            $table->string('estatusfs', 100);
            $table->string('estatusfe', 100);

            $table->integer('idfuncionarioe')->default(0);
            $table->integer('idfuncionarios')->default(0);


            $table->integer('idorganigrama')->default(0);
            $table->integer('idmunicipio')->default(0)->nullable();;

            $table->date("fecha_alta");
            $table->date("fecha_baja"); 

            $table->string('profesion',150)->nullable();
            $table->string('nivelacademico', 150)->nullable();
            $table->integer('gradoacademico')->nullable();
            $table->string('categoria',150);
            $table->string('experencia',150);

            $table->string('doc_academico',150)->nullable();
            $table->string('doc_cv',150)->nullable();
            $table->string('doc_ine',150)->nullable();
            $table->string('doc_nombramiento',150)->nullable();
            $table->string('doc_acuse',150)->nullable();
            $table->string('doc_protesta',150)->nullable();
            $table->string('doc_renuncia',150)->nullable();
            $table->string('doc_formato',150)->nullable();

            $table->decimal('sueldoneto', $precision = 15, $scale = 2)->default(0);
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
        Schema::dropIfExists('cat_nombramientos');
    }
}
