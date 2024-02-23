<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnableNullDescripcion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adq_cat_articulos', function (Blueprint $table) {
            DB::statement('ALTER TABLE `adq_cat_articulos` MODIFY `descripcion` VARCHAR(255) NULL;');
         //   $table->string('descripcion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
