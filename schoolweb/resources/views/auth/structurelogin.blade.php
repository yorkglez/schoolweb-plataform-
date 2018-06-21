<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/loginstyles.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
  {{-- Body nav --}}
  <nav class="navbar navbar-expand-lg  navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
    School web
    </a>
    {{-- Nav options --}}
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li  class="nav-item"><a class="nav-link"><span class="sr-only">(current)</span></a></li>
        <li class="l1 nav-item">
        	<a class="nav-link" href="{{ route('student.login') }}">
        		<i class="fa fa-graduation-cap" aria-hidden="true"></i>
        		Alumnos
        	</a>
      	</li>
        <li class="l2 nav-item">
        	<a class="nav-link" href="{{ route('teacher.login') }}">
        		<i class="fa fa-sign-in" aria-hidden="true"></i> Maestros
      		</a>
  	    </li>
        {{-- <li class="l3 nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Personal
          </a>
        </li> --}}
      </ul>
    </div>
    <span>Created by malastareas</span>
  </nav>
  {{-- Container  --}}
  <div class="container-fluid">
      <div class="wrapper">
          <h1>Iniciar sesion</h1>
          <h3>@yield('type')</h3>
          {{-- Login form --}}
          @yield('form')
      </div>
  </div>
  {{-- Scripts --}}
  <script src="{{ asset('plugins/jquery/jquery-3.1.1.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script>
    // Login error messages
    @if (Session::has('invalid'))
      $('#email').addClass('is-invalid');
    @endif
    $('#email').on('keypress', function() {
      $('#email').removeClass('is-invalid');
    });
  </script>
  {{-- Other scrips --}}
  @yield('js')
</body>
</html>
