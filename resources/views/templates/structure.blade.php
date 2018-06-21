<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/structure-studentstyles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navstyles.css') }}">
    @yield('css')
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark" >
            {{-- <a class="navbar-brand" href="#"><img src="images/bootstraplogo.jpg" alt="" height="" width="40px"></a> --}}
            <li id="musername" class=" nav-link"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }} {{Auth::user()->lastname}}</li>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li  class="nav-item active"><a class="nav-link" href="{{ route('student.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ratings.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>
                    Calificaciones</a></li>
                {{--     <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-book" aria-hidden="true"></i> Materias</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('indexschedule_student') }}"><i class="fa fa-book" aria-hidden="true"></i> Mi horario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.porfile') }}"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('academicload.create') }}"><i class="fa fa-archive" aria-hidden="true"></i> Carga horaria</a></li>

                    <li id="mlogout" class=" nav-item "><a class="nav-link" href="{{ route('student.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion</a>
                </ul>
            </div>
            <ul class="idesktop navbar-nav flex-row ml-md-auto d-none d-md-flex">
                <li id="link-username" class=" nav-link"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }} {{Auth::user()->lastname}}</li>
                <li id="link-logout" class=" nav-item "><a class="nav-link" href="{{ route('student.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion</a>
                   <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
        @yield('content')
    </div>
    <footer class="footer " role="contentinfo">
        <div class="content-footer  positon-relative">
            <p id="contact">Contacto</p>
            <ul id="footer-social">
                <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a  id="tel" href="tel:+523841047758"><i class="fa fa-phone" aria-hidden="true"></i>{{-- <p>+523841047758</p> --}}</a></li>
            </ul>
            <p id="reserved">© Copyright 2017 All Rights Reserved | Create by malastareasteam | Monkey's develop</p>
        </div>
    </footer>
    <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/navitem-active.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
