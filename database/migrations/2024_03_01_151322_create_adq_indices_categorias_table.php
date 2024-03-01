<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdqIndicesCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adq_indices_categorias', function (Blueprint $table) {
            $table->id();
            // Creamos las 20 columnas INDEX como enteros (int)
            for ($i = 1; $i <= 20; $i++) {
                $table->integer('INDEX' . $i)->nullable();
            }
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
        Schema::dropIfExists('adq_indices_categorias');
    }
}
