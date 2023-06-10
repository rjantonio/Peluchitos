<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use App\Models\Articulo;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    //

    public function misPedidos() {
        return view('home.mispedidos');
    }

    public function getAllPedidos() {

        $todo = DB::table('pedido')->get();

        return $todo;
    }

    public function getPedidosById($id) {

        $todo = DB::select("SELECT * FROM pedido WHERE usuario_id = '$id'");

        return $todo;
    }

    public function getItems($pedido) {

       /*  $todo = DB::table('pedido_articulo')->where('pedido_id', $pedido)->value('articulo_id','cantidad'); */
       $todo = DB::select("SELECT * FROM pedido_articulo WHERE pedido_id = '$pedido'");

        return $todo;

    }

    public function cambiarEstado($idP, $estado) {

        DB::table('pedido')->where('idP',$idP)->update(['estado' => $estado]);

        return redirect()->back()->with('message', 'actualizado');   
    }



    public function pedido($idU, $total){

        /* DB::table('pedido')->insert([
            'usuario_id' => $idU,
            'total' => $total,
        ]); */

        $pedido = new Pedido();
        $pedido->usuario_id = $idU;
        $pedido->total = $total;
        $pedido->save();
        
        foreach(session('cart') as $id => $item) {
            DB::table('pedido_articulo')->insert([
                'articulo_id' => $id,
                'pedido_id' => $pedido->id,
                'cantidad' => $item['cantidad'],
            ]);
        }

        session()->forget('cart');
        session()->flash('success', 'Pedido realizado con éxito');

        return view('home.carrito');
    }

}