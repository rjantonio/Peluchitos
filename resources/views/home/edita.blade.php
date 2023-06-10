<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Editar</title>
</head>
<body>

@php

    use App\Http\Controllers\HomeController;



    $usuario = Session::get('usuario');


    $user = session()->get('usuario');

    $aux = json_decode(json_encode($user[0]), true);

    $user = $aux;

    $articulo = HomeController::getById($idA);

    $aux = json_decode(json_encode($articulo[0]), true);

    $articulo = $aux;


@endphp

@include('home.nav')



    <form method="POST" action="/updateDB">
    @csrf
    <input type="hidden" name="id" value="{{ $articulo['idA'] }}">
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre:</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" value="{{ $articulo['nombre'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="tipo" class="col-sm-2 col-form-label"><b>Tipo:</b></label>
                <div class="col-sm-10">
                <select name="tipo" class="form-control">
                        <option value="Manta" selected="selected">Manta</option>
                        <option value="Peluche">Peluche</option>
                        <option value="Pulsera">Pulsera</option>
                        <option value="Monedero">Monedero</option>
                        <option value="Bolso">Bolso</option>
                        <option value="Otro">Otro</option>
                </select>
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="precio" class="col-sm-2 col-form-label"><b>Precio:</b></label>
                <div class="col-sm-10">
                <input type="number" step="any" class="form-control" name="precio" value="{{ $articulo['precio'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="stock" class="col-sm-2 col-form-label"><b>Stock:</b></label>
                <div class="col-sm-10">
                <input type="number" step="any" min="0" class="form-control" name="stock" value="{{ $articulo['stock'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="descripcion" class="col-sm-2 col-form-label"><b>Descripción:</b></label>
                <textarea class="form-control" name="descripcion" rows="10">{{ $articulo['descripcion'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 40%">Actualizar información</button>
    </form>

    <img src="{{ $articulo['imagen'] }}" style="width: 40%;height: auto;position:absolute;top:0;right:0;padding:10vh" alt="">

</body>




</html>