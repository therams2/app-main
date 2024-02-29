<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecioKiloToAdqCatArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adq_cat_articulos', function (Blueprint $table) {
            $table->decimal('precio_kilo', $precision = 15, $scale = 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adq_cat_articulos', function (Blueprint $table) {
            //
        });
    }
}
