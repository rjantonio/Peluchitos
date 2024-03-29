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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $articulo['nombre'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="tipo" class="col-sm-2 col-form-label"><b>Tipo:</b></label>
                <div class="col-sm-10">
                <select name="tipo" id="tipo" class="form-control">
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
                <input type="number" step="any" class="form-control" id="precio" name="precio" value="{{ $articulo['precio'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="stock" class="col-sm-2 col-form-label"><b>Stock:</b></label>
                <div class="col-sm-10">
                <input type="number" step="any" min="0" class="form-control" id="stock" name="stock" value="{{ $articulo['stock'] }}">
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="descripcion" class="col-sm-2 col-form-label"><b>Descripción:</b></label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="10">{{ $articulo['descripcion'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 40%">Actualizar información</button>
    </form>

    @if( strlen($articulo['imagen']) < 17) 
        <img src="{{ asset('storage/storage/images/'.  $articulo['imagen']) }}" style="width: 40%;max-height:600px;height: auto;position:absolute;top:0;right:0;padding:10vh;z-index: -1" alt="">
    @else 
        <img src="{{ $articulo['imagen']; }}" style="width: 40%;max-height:6000px;height: auto;position:absolute;top:0;right:0;padding:10vh;z-index: -1" alt=""> 
    @endif

</body>




</html>