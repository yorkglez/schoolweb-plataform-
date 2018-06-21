<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sidebarstyles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/structurestyles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navstyles.css') }}">
    @yield('css')
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top postion-absolute" >
      <button id="btnmside" class="navbar-toggler" type="button" >
          <span class="navbar-toggler-icon"></span>
      </button>
      {{-- <a class="navbar-brand" href="#"><img src="images/bootstraplogo.jpg" alt="" height="" width="40px"></a> --}}
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li id="musername" class=" nav-link"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }} {{Auth::user()->lastname}}</li>
            <li class="navname"><h3 style="color: white; position: relative; left: -10px;">Web maestros</h3></li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('teacher.index') !!}"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <buttom id="btnsidebar" class="nav-link" type="buttom"><i class="fa fa-minus-square" aria-hidden="true"></i> Menu</buttom>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('porfile.teacher') }}"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a>
            </li>
            <li id="mlogout" class=" nav-item "><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion</a>
              {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form> --}}
            </li>
        </ul>
        <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
          <li id="link-username" class=" nav-link">{{ Auth::user()->name }} {{Auth::user()->lastname}}</li>
          <li  id="link-logout" class=" nav-item ">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <div id="wrapper" class="toggled">
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand">
            Dashboard
          </li>
          <li class="nav-item">
            <a href="{{ route('modules.create') }}" class="nav-link"><i class="fa fa-archive" aria-hidden="true"></i><span class="sidetext">Crear Unidades</span></a>
          </li>
          <li class="nav-item">
            <a href="{{ route('ratings.create') }}" class="nav-link"><i class="fa fa-list-alt" aria-hidden="true"></i> <span class="sidetext">Calificaciones</span></a>
          </li>
          <li class="nav-item">
            <a href="{{ route('assignaments.index') }}" class="nav-link"><i class="fa fa-briefcase" aria-hidden="true"></i> <span class="sidetext"> Registro de trabajos</span></a>
          </li>
          <li class="nav-item">
            <a class="students-link nav-link" href="{{ route('attendancelist.index') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span class="sidetext">Control de asistencias</span></a>
          </li>
          <li class="nav-item">
            <a class="students-link nav-link" href="{{ route('attendancelist.history') }}"><i class="fa fa-history" aria-hidden="true"></i> <span class="sidetext">Historial asistencias</span> </a>
          </li>
          <li class="nav-item">
            <a class="students-link nav-link" href="{{ route('indexschedule_teacher') }}"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="sidetext">Horario</span> </a>
          </li>
        </ul>
      </div>
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
               @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="{!! asset('js/sidebar.js') !!}"></script>
    <script src="{!! asset('js/sideitemactive.js') !!}"></script>
    @yield('js')
</body>
</html>
