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
    @yield('css')
</head>
<body>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top postion-absolute" >
        <a class="navbar-brand" href="#"><img src="images/bootstraplogo.jpg" alt="" height="" width="40px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
              <li><h3 style="color: white; position: relative; left: -20px;">Web academico</h3></li>
              <li class="nav-item active">
                  <a class="nav-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a>
              </li>
              <li class="nav-link">User name</li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion</a>
              </li>
          </ul>
        </div>
        </nav>
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block sidebar">
                <ul class="nav nav-pills flex-column">
                    <br>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('indexratings') }}">Calificaciones</a>
                    </li>
                    <li class="nav-item">
                      <a class="students-link nav-link" href="{{ route('indexstudentsbyscareer') }}" >Alumnos</a>         
                    </li>
                    <li class="nav-item">
                      <a class="students-link nav-link" href="{{ route('createsubjectlist') }}" >Registro de materias</a>         
                    </li>
                  {{--  <ul class="sidebar-subnav">
                    <li class="nav-item"><a href="{{ route('showstudents',14) }}" class="nav-link">Sistemas</a></li>
                    <li class="nav-item"><a href="{{ route('showstudents',2) }}" class="nav-link">Inoviacion</a></li>
                    <li class="nav-item"><a href="{{ route('showstudents',3) }}" class="nav-link">Ing. Industrial</a></li>
                    <li class="nav-item"><a href="{{ route('showstudents',15) }}" class="nav-link">Ing. en Administracion</a></li>
                    <li class="nav-item"><a href="{{ route('showstudents',5) }}" class="nav-link">Arquitectura</a></li>
                  </ul> --}}
                   {{--  <li class="nav-item">
                      <a class="nav-link" href="{{ route('indexteachers') }}">Maestros</a>
                    </li> --}}
                   {{--  <li class="nav-item">
                      <a class="nav-link" href="{{ route('createstudent') }}">Registro de alumno</a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('createteacher') }}">Registro de maestro</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Solicitudes</a>
                    </li> --}}
                </ul>
            </nav> 
            <main role="main" style=" padding: 5px; position: relative; top: 60px; background: none;" class="col-sm-9 ml-sm-auto  col-md-10 pt-3">
              @yield('content')
            </main>
        </div>    
    </div>
    <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    @yield('js')
   {{--  <script>
      $('.students-link').on('click',function(){
        $('.sidebar-subnav').toggle();
      });
    </script> --}}

</body>
</html>








