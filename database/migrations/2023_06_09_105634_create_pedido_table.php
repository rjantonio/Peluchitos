<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('idP');
            $table->decimal('total',7,2);
            $table->boolean('estado')->default(0); //0 No entregado, 1 entregado

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');

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
        Schema::dropIfExists('pedido');
    }
}
