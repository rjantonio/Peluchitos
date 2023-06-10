<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Articulo;
use Illuminate\Support\Facades\Auth;

class CarroController extends Controller
{

    public function show(){
        if(Auth::check()) {
            //return redirect('/carrito');
            $products = Articulo::all();
            return view('home.carrito');
        }
        return redirect('login');
    }

    public function add ($idA, $cantidad) {

        /* $product = Articulo::findOrFail($idA); */
        //$product = Articulo::all();

        $product = HomeController::getById($idA);

        $aux = json_decode(json_encode($product[0]), true);

        $product = $aux;

        $cart = session()->get('cart', []);

        if (isset($cart[$idA])) {
            if (($cart[$idA]['cantidad'] + $cantidad) > $product['stock']) {
                $cart[$idA]['cantidad'] = $product['stock'];
            } else {
                $cart[$idA]['cantidad']+= $cantidad;
            }
            
        } else {
            $cart[$idA] = [
                "nombre_articulo" => $product['nombre'],
                "imagen" => $product['imagen'],
                "precio" => $product['precio'],
                "stock" => $product['stock'],
                "cantidad" => $cantidad,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto añadido');

    }

    public function remove(Request $request) {

        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado');
        }
    }


}

