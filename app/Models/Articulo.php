<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articulo extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'articulo';

    protected $fillable = [
        'tipo',
        'precio',
        'stock',
        'imagen',
        'puntuacion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

     //Relación Muchos a Muchos
     public function pedido() {
        return $this->belongsToMany(Pedido::class, 'idP');
     }

}
