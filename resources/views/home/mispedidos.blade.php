<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluchitos</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/adminpedidos.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  </head>
<body>


@php

    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\PedidoController;

    
    

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

    $pedidos = PedidoController::getPedidosById($user['id']);


@endphp


   
@include('home.nav')


<table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:10%">IDCliente</th>
                <th style="width:10%">Precio</th>
                <th style="width:60%">Detalles del Pedido</th>
                <th style="width:10%">Estado</th>
            </tr>
        </thead>

        <tbody>
          @foreach ($pedidos as $id => $pedido)
          <tr data-id="{{ $id }}">

              <td class="font-italic">{{$pedido->idP}}</td>
              <td><b>{{$pedido->usuario_id}}</b></td>
              <td class="text-info font-weight-bold">{{$pedido->total}}€</td>
              <td>
                @php
                    $items = PedidoController::getItems($pedido->idP);
                @endphp
                @foreach($items as $item) 
                    @php  $imagen = HomeController::getImagenById($item->articulo_id)  @endphp
                    <span style="padding: 5px" class="price text-primary font-weight-bold pedidoimagen">
                    @if( strlen($imagen) < 17) 
                        <img src="{{ asset('storage/storage/images/'.  $imagen) }}" height="50px" width="50px" alt="">
                    @else 
                        <img src="{{ $imagen; }}"  height="50px" width="50px" alt="">
                    @endif
                    </span><span class="text-danger font-weight-bold">Cantidad: {{ $item->cantidad }}</span>
                @endforeach
                    
                
              </td>
              <td>
                @if($pedido->estado == 0)
                <span style="padding: 5px" class="price text-warning font-weight-bold">En proceso</span>
                @else 
                <span style="padding: 5px" class="price text-primary font-weight-bold">Entregado</span>
                @endif
              </td>


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