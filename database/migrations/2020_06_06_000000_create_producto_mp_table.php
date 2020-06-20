<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoMpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_mp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id',false)->references('id')->on('producto');;
            $table->unsignedBigInteger('materia_prima_id',false)->references('id')->on('materia_prima');;
            $table->double('cantidad');
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
        Schema::dropIfExists('producto_mp');
    }
}
