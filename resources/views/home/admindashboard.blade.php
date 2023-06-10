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
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  </head>
<body>


@php

    use App\Http\Controllers\HomeController;

    
    

    $usuario = Session::get('usuario');

    //var_dump ($usuario['idusu']);

    if(isset($busqueda)) {
        $lista = HomeController::getTipo($busqueda);
        if(empty($lista)) {
            $lista = [0];
        }
    } else {
        $lista = HomeController::getAll();
    }

  
    //var_dump ($lista[0]);

    $array = json_decode(json_encode($lista[0]), true);

    //var_dump($array);
    //var_dump(session()->all());

    $user = session()->get('usuario');

    $aux = json_decode(json_encode($user[0]), true);

    $user = $aux;

    //var_dump($user);

@endphp


   
@include('home.nav')


<table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:10%">Articulo</th>
                <th style="width:10%">Tipo</th>
                <th style="width:10%">Precio</th>
                <th style="width:10%">Stock</th>
                <th style="width:45%">Descripcion</th>
                <th style="width:5%"></th>
                <th style="width:5%"></th>
            </tr>
        </thead>

        <tbody>
          @foreach ($lista as $id => $item)
          @php $array = json_decode(json_encode($item), true); @endphp
          <tr data-id="{{ $array['idA'] }}">

              <td><img src="{{$array['imagen']}}" alt=""></td>
              <td id="fototexto"><b>{{$array['nombre']}}</b></td>
              <td>{{$array['tipo'] }}</td>
              <td>{{$array['precio'] }}€</td>
              <td>{{$array['stock'] }}</td>
              <td>{{$array['descripcion'] }}</td>
              <td><a href="/updateButton/{{ $array['idA'] }}"><button type="button" class="btn btn-primary edit_item">Editar</button></a></td>
              <td><a href="#"><button type="button" class="btn btn-danger remove_item">Borrar</button></a></td>

          </tr>
          @endforeach
        </tbody>
        <tfoot>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif 
            @if(isset($message))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif 
        </tfoot>

      </table>

</body>


      <!-- Elimina Artículo de la BBDD -->

<script type="text/javascript">

$(".remove_item").click(function(e) {
  e.preventDefault();

  var ele = $(this);


  if(confirm('Estás seguro que quieres ELIMINAR este producto?')) {
    $.ajax({
      url: '{{ route('removeDB') }}',
      method: "DELETE",
      data: {
        _token: '{{ csrf_token() }}',
        id: ele.parents("tr").attr("data-id")
      },
      success: function (response) {
        window.location.reload();
      },
      error: function(request,msg,error) {
        console.log(request);
    }
    })
  }
});




</script>



</html>