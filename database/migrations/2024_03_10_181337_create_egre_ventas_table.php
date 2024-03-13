<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgreVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ing_cat_ventas', function (Blueprint $table) {
            $table->id();
            $table->decimal('totalventa',$precision = 15, $scale = 2)->nullable();
            $table->decimal('importe',   $precision = 15, $scale = 2)->nullable();
            $table->decimal('cambio',    $precision = 15, $scale = 2)->nullable();
            $table->string('estatus', 10);
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
        Schema::dropIfExists('egre_ventas');
    }
}
