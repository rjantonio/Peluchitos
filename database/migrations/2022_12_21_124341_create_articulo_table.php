<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->id('idA');
            $table->string('nombre', 255);
            $table->enum('tipo', ['Manta', 'Peluche', 'Pulsera', 'Monedero', 'Bolso', 'Otro']);
            $table->double('precio', 15, 2);
            $table->integer('stock');
            $table->string('descripcion');
            $table->string('imagen');
            $table->integer('puntuacion');
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
        Schema::dropIfExists('articulo');
    }
}
