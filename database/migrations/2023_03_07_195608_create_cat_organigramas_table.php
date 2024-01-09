<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatOrganigramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_organigramas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 150);
            $table->integer('idfuncionario')->default(0);
            $table->integer('idparent')->default(0);
            $table->smallInteger('orden')->default(0);
            $table->smallInteger('nivel')->default(0);
            $table->boolean('estatus')->default(1);
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
        Schema::dropIfExists('cat_organigramas');
    }
}
