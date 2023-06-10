<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Crear cuenta</title>
</head>
<body>
    <div class="login-dark">
        <form method="post">
        @csrf
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="name" required autofocus name="nombre" value="{{ old('nombre') }}" placeholder="Nombre"></div>
            <div class="form-group"><input class="form-control" type="email" required name="email" value="{{ old('email') }}" placeholder="Correo"></div>
            <div class="form-group"><input class="form-control" type="password" required name="password" placeholder="Contraseña"></div>
            <div class="form-group"><input class="form-control" type="password" required name="passwordconf" placeholder="Confirme Contraseña"></div>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Crear cuenta</button></div></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>


</html>