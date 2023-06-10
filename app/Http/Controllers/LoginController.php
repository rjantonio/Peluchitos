<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function show(){
        if(Auth::check()) {
            return redirect('/home');
        }
        return view('home.login');
    }

    public function login (LoginRequest $request) {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            /* $request->session()->regenerate(); */

            $request->session()->start();

            $user = HomeController::getUsuarioByEmail($request['email']);

            $request->session()->put('usuario', $user);

            /* Session::put('usuario', $user); */


            return redirect()->intended('home')
            ->with('status', 'Ha iniciado sesión');

        } else {
            return redirect()->back()->withErrors('El usuario o la contraseña son erróneos');
        }

    }

    public function logout () {

        session()->flush();
        Auth::logout();

        return redirect()->intended('home');
    }

    /* public function login(LoginRequest $request) {

        //obtiene los valores del formulario login, comprueba que correspondan con los de la bbdd y crea una sesión, asimismo, redirige al home
        $credentials = $request->getCredentials();


        if (!Auth::validate($credentials)) {
            return view('home.login')->with('error', 1);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);


        //$request->session()->put('nombre', $credentials['email']);

        //return $this->authenticated($request, $user);

        session(['usuario' => $user]);


        return view('home.index');

    } */
}
