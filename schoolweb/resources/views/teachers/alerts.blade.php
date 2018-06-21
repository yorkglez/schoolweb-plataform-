{{-- Alerts teacher--}}
@extends('templates.structure-teacher')
@section('title','Registro de trabajos')
@section('css')
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection
@section('content')
  <div id="alert" class="alert alert-{{ $alert['type'] }}" role="alert">
    <h4 class="alert-heading">{!! $alert['head']!!}</h4>
    <p>{!! $alert['message']!!}</p>
    <hr>
    <p class="mb-0"></p>
  </div>
@endsection
@section('js')
  <script>

  </script>
@endsection
