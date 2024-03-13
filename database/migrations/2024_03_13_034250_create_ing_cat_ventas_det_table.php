<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngCatVentasDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ing_cat_ventas_det', function (Blueprint $table) {
            $table->id();
            $table->integer('idcatarticulos');
            $table->integer('idcatventas');
            $table->integer('idunidadtipo')->nullable();
            $table->integer('idcar');
            $table->integer('idunidadmedida')->nullable();
            $table->string('concepto', 250);
            $table->string('code', 250);
            $table->decimal('cantidad',  $precision = 15, $scale = 2)->nullable();
            $table->decimal('precio',    $precision = 15, $scale = 2)->nullable();
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
        Schema::dropIfExists('ing_cat_ventas_det');
    }
}
