<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    //Relación Uno a Muchos
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id');
    }

    //Relación Muchos a Muchos
    public function articulo() {
        return $this->hasMany(Articulo::class, 'idA');
    }
}
