<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/index"><img src="{{ asset('storage/storage/images') }}/logo.svg" height="30px" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ">
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('aboutus') }}">Sobre nosotros</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="desple" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Buscar
              </a>
              <div class="dropdown-menu" aria-labelledby="desple">
                <a class="dropdown-item" href="{{ route('index') }}">Todo</a>
                <a class="dropdown-item" href="/busqueda/Manta">Mantas</a>
                <a class="dropdown-item" href="/busqueda/Peluche">Peluches</a>
                <a class="dropdown-item" href="/busqueda/Bolso">Bolsos</a>
              </div>
            </li>
          </ul>

            <!-- Botón que lleva al dashboard de admins -->

            @if($user['isAdmin'] == 1) 
                <div class="collapse navbar-collapse panel">
                    <a href="{{ route('pedidosAdmin') }}" class="btn btn-primary w-50 panel">Gestionar Pedidos</a>
                </div>
                <div class="collapse navbar-collapse panel">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary w-50 panel">Gestionar Artículos</a>
                </div>
            @endif

        </div>
        @guest
        <a href="/login">Iniciar sesión</a>
        <a href="/register">Crear cuenta</a>
        @endguest
        @auth




        <!-- Botón carrito y su desplegable -->
        
        <div id="cart_container">

          <a href="/carrito"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg></a>
          @if(count((array) session('cart')) > 0 )
          <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span> 
          @endif   
          
          <div id="cart_dropdown" class="dropdown-menu">
            <div class="row header_section">
              @php $total = 0 @endphp
              @foreach ((array) session ('cart') as $id => $details)
                @php $total += $details['precio'] * $details['cantidad'] @endphp
              @endforeach
              <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                <p>Total: <span class="text-info">{{ $total }}€</span></p>
              </div>
            </div>
            @if(session('cart'))
              @foreach(session('cart') as $id => $details)
                <div class="row cart-detail">
                  <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                  @if( strlen( $details['imagen']) < 17) 
                      <img src="{{ asset('storage/storage/images/'.   $details['imagen']) }}" height="70px" width="100%" alt="">
                  @else 
                      <img src="{{  $details['imagen'] }}" alt="">
                  @endif
                  </div>
                  <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                    <p>{{ $details['nombre_articulo'] }}</p>
                    <span class="price text-info">{{ $details['precio'] }}€</span><span class="count">Cantidad: {{ $details['cantidad'] }}</span>
                  </div>
                </div>
              @endforeach
            @endif
            <div class="row">
              <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <a href="{{ route('carrito')}}" class="btn btn-primary btn-block">Ver todo</a>
              </div>
            </div>
          </div>

        </div>

        <!-- Botón que dice Bienvenido y tiene cerrar sesión como desplegable -->
        <div class="nav-item dropdown">
              <a class="navbar-brand nav-link dropdown-toggle" href="#" id="logout" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bienvenid@, {{ $user['nombre'] }}</a>
              </a>
              <div class="dropdown-menu" aria-labelledby="logout">
                <a class="dropdown-item" href="/mispedidos">Mis Pedidos</a>
                <a class="dropdown-item" href="/wishlistShow">Lista de Deseados</a>
                <a class="dropdown-item" href="/logout">Cerrar Sesión</a>
              </div>
        </div>

        @endauth
      </nav>