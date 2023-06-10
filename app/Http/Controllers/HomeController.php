<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    /* public function __construct() {
        $this->middleware('auth');
    } */


    public function index(Request $request) {

        return view('home.index');

        //return $request->session()->all();
        
    }

    public function show () {
        return view('home.index');
    }

    public function dashboard () {
        return view('home.admindashboard');
    }

    public function pedidosShow () {
        return view('home.adminpedidos');
    }

    public function aboutus () {
        return view('home.aboutus');
    }

    public function getAll () {

        $todo = DB::select("SELECT * FROM articulo");

        return $todo;

    }

    public function getTipo ($tipo) {

        $todo = DB::select("SELECT * FROM articulo WHERE tipo = '$tipo'");

        return $todo;

    }

    public function getById ($id) {

        $articulo = DB::select("SELECT * FROM articulo WHERE idA = '$id'");

        return $articulo; 
        
    }

    public function detalle ($articulo) {

        return view('home.detalle')->with('articulo', $articulo);

    }

    public function getUsuarioByEmail ($email) {

        $user = DB::select("SELECT * FROM usuario WHERE email = '$email'");

        return $user;

    }

    public function puntua ($arti, $nota) {

        DB::table('articulo')->where('idA',$arti)->update(['puntuacion' => $nota]);

        return redirect()->back()->with('message', 'actualizado');   

    }

    public function busqueda ($tipo) {

        return view('home.index')->with('busqueda', $tipo);   
        
    }

    /*  */

    public function updateButton (Request $request) {
        return view('home.edita')->with('idA', $request->idA);
    }

    public function updateDB () {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $descripcion = $_POST['descripcion'];

        DB::table('articulo')->where('idA',$id)->update( array('nombre'=>$nombre, 'tipo'=>$tipo, 'precio'=>$precio, 'stock'=>$stock, 'descripcion'=>$descripcion) );

        return view('home.admindashboard')->with('message', 'Actualizado con éxito');   
    }

    public function removeDB (Request $request) {

        DB::table('articulo')->where('idA', $request->id)->delete();

        session()->flash('success', 'Producto eliminado de la BD');
        return view('home.admindashboard');

    }
}