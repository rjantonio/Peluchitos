<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\PedidoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'show']);

Route::get('/index', [HomeController::class, 'show'])->name('index');

Route::get('/busqueda/{tipo}', [HomeController::class, 'busqueda']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/detalle/{parametro?}', [HomeController::class, 'detalle']);

Route::get('/detalle/{parametro?}/{parametro1?}', [HomeController::class, 'puntua']);

Route::get('/carrito', [CarroController::class, 'show'])->name('carrito');

Route::get('/add/{id?}/{cantidad}', [CarroController::class, 'add'])->name('add')->middleware('auth');

Route::delete('/remove', [CarroController::class, 'remove'])->name('remove');

Route::get('/adminDashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('admin');

Route::get('/pedidosAdmin', [HomeController::class, 'pedidosShow'])->name('pedidosAdmin')->middleware('admin');

Route::delete('/removeDB', [HomeController::class, 'removeDB'])->name('removeDB');

Route::get('/updateButton/{idA?}', [HomeController::class, 'updateButton'])->name('updateButton');

Route::post('/updateDB', [HomeController::class, 'updateDB'])->name('updateDB');

Route::get('/pedido/{idU?}/{total?}', [PedidoController::class, 'pedido'])->name('pedido');

Route::get('/cambiarEstado/{idP?}/{estado?}', [PedidoController::class, 'cambiarEstado'])->name('cambiarEstado');

Route::get('/mispedidos/{id?}', [PedidoController::class, 'misPedidos']);

Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');