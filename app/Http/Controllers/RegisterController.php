<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function show(){
        if(Auth::check()) {
            return redirect('/home');
        }
        return view('home.register');
    }

    public function register(RegisterRequest $request) {

        //$usuario = Usuario::create($request->validated());

        //return redirect('/login');

        $user = new Usuario();
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->password = $request->password;
        $res = $user->save();
        
        Auth::login($user);

        $user = HomeController::getUsuarioByEmail($request['email']);

        $request->session()->put('usuario', $user);

        return redirect(route('home'));

    }
}
