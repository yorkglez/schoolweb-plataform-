{{-- complete regist student --}}
@extends('templates.structure-personal')
@section('title','Alumnos')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertsstyles.css') }}">
@endsection
@section('nav')
	@include('partials.nav-personal')
@endsection
@section('content')
	<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading">Registro completo</h4>
	  <p>El alumno a sido registrado</p>
	  <hr>
	  <p>Ingresar al portal de estudiante con el correo registrado y la contrasena temporal, cambiar la contrasena lo antes posible</p>
	  <p class="account-info mb-0"><span>Correo:</span> {{$email}}</p>
	  <p class="account-info mb-1"><span>Contrasena temporal:</span> {{$tmpcode}}</p>
	</div>
@endsection



