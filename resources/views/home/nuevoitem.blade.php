<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Crear Artículo</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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




@endphp

@include('home.nav')

@if(session('success'))
    <div class="alert alert-success">
        {{session('success') }}
    </div>
@endif 

    <form method="POST" action="/creaArticulo" enctype="multipart/form-data">
    @csrf
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre:</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" required>
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
                <input type="number" step="any" class="form-control" name="precio" required>
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="stock" class="col-sm-2 col-form-label"><b>Stock:</b></label>
                <div class="col-sm-10">
                <input type="number" step="any" min="0" class="form-control" name="stock" required>
                </div>
            </div>
            <div class="form-group row" style="margin: 10px; width: 50%">
                <label for="descripcion" class="col-sm-2 col-form-label"><b>Descripción:</b></label>
                <textarea class="form-control" name="descripcion" rows="10" required></textarea>
            </div>

            <!-- foto -->
            <div style="width: 40%;height: auto;position:absolute;top:0;right:0;margin:10vh">
                <div>
                    <div class="mb-4 d-flex justify-content-center">
                        <img id="preview" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                        class="img-fluid rounded shadow-sm mx-auto d-block" style="width: 500px;border: 2px dashed rgba(255, 255, 255, 0.7);padding: 1rem;" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="inputimagen">Choose file</label>
                            <input type="file" class="form-control d-none" name="inputimagen" id="inputimagen" required accept="image/*"/>
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 40%">Crear Artículo</button>
    </form>


</body>

<script type="text/javascript">

    $('#inputimagen').change(function (e) {

        console.log(event.target.files[0]);

        var image = URL.createObjectURL(e.target.files[0]);

        $('#preview')
                .attr('src', image);

    });

</script>


</html>