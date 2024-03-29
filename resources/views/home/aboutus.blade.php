<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluchitos</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>


@php

    use App\Http\Controllers\HomeController;



    $usuario = Session::get('usuario');

    //var_dump ($usuario['idusu']);

    if(isset($busqueda)) {
        $lista = HomeController::getTipo($busqueda);
        if(empty($lista)) {
            $lista = null;
        }
    } else {
        $lista = HomeController::getAll();
    }

  
    //var_dump ($lista[0]);


    //var_dump($array);
    //var_dump(session()->all());

    $user = session()->get('usuario');

    $aux = json_decode(json_encode($user[0]), true);

    $user = $aux;

    //var_dump($user);

@endphp


   
@include('home.nav')

<!-- <div id="top" style="width:100%;height:auto;background-color:blue;">
    <div id="nosotros">¿Quién soy?</div>
    <div id="respuesta">Soy asñlfkasñlfjk</div>
</div> -->

<div class="bg-light">
  <div class="container py-5">
    <div class="row h-100 align-items-center py-5">
      <div class="col-lg-5">
        <h1 class="display-4">Sobre Mí</h1>
        <p class="lead text-muted mb-0">Soy María Concepción, madre de Antonio, que va a sacar muy buena nota en este proyecto; me encanta hacer manualidades y en esta página os ofrezco adquirir algunos de mis productos hechos a mano con mucho cariño =)</p>
      </div>
      <div class="col-lg-7 d-none d-lg-block"><video width="960" height="720" controls  style="display:block;margin-left:auto;margin-right:auto">
        <source src="{{ asset('storage/storage/video/aboutus.mp4')}}" type="video/mp4">
        Tu navegador no puede reproducir vídeo :(
    </video></div>
    </div>
  </div>
</div>

<!-- <div id="center">
    <video width="960" height="720" controls  style="display:block;margin-left:auto;margin-right:auto">
        <source src="{{ asset('storage/storage/video/aboutus.mp4')}}" type="video/mp4">
        Tu navegador no puede reproducir vídeo :(
    </video>
</div> -->

      


</body>



</html>