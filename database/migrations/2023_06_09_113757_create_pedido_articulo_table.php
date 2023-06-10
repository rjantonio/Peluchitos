<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_articulo', function (Blueprint $table) {
            
            $table->unsignedBigInteger('articulo_id');
            $table->foreign('articulo_id')->references('idA')->on('articulo')->onDelete('cascade');
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('idP')->on('pedido')->onDelete('cascade');
            
            $table->primary(['articulo_id','pedido_id']);
            
            $table->integer('cantidad');

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
        Schema::dropIfExists('pedido_articulo');
    }
}
