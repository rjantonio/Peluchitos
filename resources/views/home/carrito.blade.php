<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
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

    
    

    $usuario = Session::get('usuario');

    //var_dump ($usuario['idusu']);

    $lista = HomeController::getAll();
  
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

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif 


      <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Articulo</th>
                <th style="width:10%">Precio</th>
                <th style="width:8%">Cantidad</th>
                <th style="width:22%" class="text-center">Suma</th>
                <th style="width:10%"></th>
            </tr>
        </thead>

        <tbody>
        @php $total = 0 @endphp
        @if ((session('cart')) != null )
          @foreach (session('cart') as $id => $item)
          @php $total += $item['precio'] * $item['cantidad'] @endphp
          <tr data-id="{{ $id }}">

              <td id="fototexto">
                  @if( strlen($item['imagen']) < 17) 
                      <img src="{{ asset('storage/storage/images/'.  $item['imagen']) }}"  height="100" width="100" alt="">
                  @else 
                      <img src="{{ $item['imagen']; }}"  height="100" width="100" alt="">
                  @endif
                <b>{{$item['nombre_articulo']}}</b>
              </td>
              <td>{{$item['precio']??0 }}€</td>
              <td><input id="numinp" type="number" value="{{$item['cantidad']??0 }}" min="1" max="{{$item['stock'] }}" class="form-control"></td>
              <td  id="sumacant" class="text-center">{{($item['cantidad']??1) * ($item['precio']??0)}}€</td>
              <td><a href="#"><button type="button" class="btn btn-danger cart_remove">Borrar</button></a></td>

          </tr>
          @endforeach
        @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="text-right"><h3><strong>Total {{ $total }}€</strong></h3></td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">
              <a href="{{ route('index') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Seguir Comprando</a>
              @if(session('cart'))
                <a href="{{ route('pedido') }}/{{ $user['id'] }}/{{ $total }}" class="btn btn-success compra"><i class="fa fa-money"></i> Checkout</a>
              @endif
            </td>
          </tr>
        </tfoot>

      </table>



<!-- Elimina los artículos del carrito -->

<script type="text/javascript">



    $(".cart_remove").click(function(e) {
      e.preventDefault();

      var ele = $(this);

      if(confirm('Estás seguro que quieres eliminar este producto?')) {
        $.ajax({
          url: '{{ route('remove') }}',
          method: "DELETE",
          data: {
            _token: '{{ csrf_token() }}',
            id: ele.parents("tr").attr("data-id")
          },
          success: function (response) {
            window.location.reload();
          }
        })
      }
    });

</script>


</body>
</html>