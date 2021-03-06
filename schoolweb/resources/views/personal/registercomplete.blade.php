{{-- Alert success --}}
@extends('templates.structure-personal')
@section('title','Completado')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertsstyles.css') }}">
@endsection
@section('content')
	<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading">Registro completo</h4>
	  <p>El {{$usertype}} a sido registrado</p>
	  <hr>
	  <p>Ingresar al portal de {{$portal}} con el correo registrado y la contrasena temporal, cambiar la contrasena lo antes posible</p>
	  <p class="account-info mb-0"><span>Correo:</span> {{$email}}</p>
	  <p class="account-info mb-1"><span>Contrasena temporal:</span> {{$tmpcode}}</p>
	</div>
@endsection
