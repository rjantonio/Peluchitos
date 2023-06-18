<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">
    <script src="{{ asset('js/detalle.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
</head>
<body>
@php

use App\Http\Controllers\HomeController;

$art = HomeController::getById($articulo);

//var_dump($art);

$array = json_decode(json_encode($art[0]), true);

//var_dump($array["imagen"]);

$user = session()->get('usuario');

    $aux = json_decode(json_encode($user[0]), true);

    $user = $aux;

@endphp

@include('home.nav')

      <input type="hidden" id="idA" value="{{ $array['idA']; }}">

<div id="todo">
    <div id="foto">
      @if( strlen($array['imagen']) < 17) 
          <img src="{{ asset('storage/storage/images/'.  $array['imagen']) }}" alt="">
      @else 
          <img src="{{ $array['imagen']; }}" alt=""> 
      @endif
    </div>
    <div id="todotexto">
      <div id="texto">
          <div id="arriba">
              <strong>{{ $array['nombre']; }}</strong>
          </div>
      </div>
      <strong style="font-size: 3vh;">{{ $array['precio'] . '€'; }}</strong><br>
      <div id="descri">
            {{ $array['descripcion']; }}
        </div>
      <div id="carrito">
        @if($array['stock'] == 0)
            <span class="text-danger"><h3>Fuera de Stock</h3></span>
        @else
          <span class="text-info font-weight-bold">Cantidad:</span>
          <select  name="cantidad" id="cantidad" >
            
              @for ($i = 1; $i <= $array["stock"]; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
              
            </select>
            
            <button type="submit" id="butcar" class="btn btn-primary"><span class="bi bi-cart"></span> Añadir al carrito</button>
            @endif

            <button type="submit" id="wishlist" class="btn btn-success"><span class="bi bi-heart"></span> Lista de Deseados</button>
          

      </div>
      <h5 class="text-success font-weight-bold">Envío gratis</h5>
    </div>
    
</div>
<div id="rating">
<i class="fa fa-star fa-2x" data-index="0" style="font-size: 3vh"></i>
                    <i class="fa fa-star fa-2x" data-index="1" style="font-size: 3vh"></i>
                    <i class="fa fa-star fa-2x" data-index="2" style="font-size: 3vh"></i>
                    <i class="fa fa-star fa-2x" data-index="3" style="font-size: 3vh"></i>
                    <i class="fa fa-star fa-2x" data-index="4" style="font-size: 3vh"></i>
</div>

@if(session('success'))
  <div style="display: inline-block" class="alert alert-success">
    {{ session('success') }}
  </div>
@endif 

@if(session('error'))
  <div style="display: inline-block" class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif 

<script>

  //Funcionamiento del sistema de estrellas

var ratedIndex = "<?php echo $array['puntuacion']; ?>";



$(document).ready(function() {

  resetStarColors();

  for (var i=0; i <= ratedIndex; i++) {
          $('.fa-star:eq('+i+')').css('color','yellow');
      }

  $('.fa-star').mouseover(function () {
      resetStarColors();


      var currentIndex = parseInt($(this).data('index'));

      for (var i=0; i <= currentIndex; i++) {
          $('.fa-star:eq('+i+')').css('color','yellow');
      }
  });

  $('.fa-star').mouseleave(function () {
      resetStarColors();

      if (ratedIndex != -1) {

          for (var i=0; i <= ratedIndex; i++) {
          $('.fa-star:eq('+i+')').css('color','yellow');
      }

      }
  });

  function resetStarColors() {
                            $('.fa-star').css('color', 'black');
                        }

  });

  $('.fa-star').on('click', function () {

  //guarda la puntuación que el usuario ha marcado.

    ratedIndex = parseInt($(this).data('index'));


    //paso la variable retedIndex a php mediante ajax

    var arti = "<?php echo $array['idA']; ?>";

    $.ajax({
      type: "GET",
      url: "" ,
      /* data: {puntuacion: 2}, */
      success: function(data)
      {
        
        location.href =   arti + "/" + ratedIndex;
      }
    }); 


  });



</script>

</body>
</html>