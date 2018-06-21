{{-- Register student --}}
@extends('templates.structure-personal')
@section('title','Registrar alumno')
@section('css')
@endsection
@section('content')
  <h2>Registrar alumno</h2>
  {!! Form::open(['route'=>'storestudents','method'=>'POST']) !!}
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="name">Nombre</label>
        <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Nombre" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="lastname">Apellidos</label>
        <input name="lastname" type="text" class="form-control" id="lastname" value="{{old('lastname')}}" placeholder="Apellidos" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="email">Correo</label>
        <input name="email" type="email" class="form-control" id="email" value="{{old('email')}}" placeholder="example@example.com" required>
        <div class="invalid-feedback">
          El correo ya esta en uso
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="phone">Telefono</label>
        <input name="phone" type="tel" class="form-control" id="phone" value="{{old('phone')}}" placeholder="3841001234" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="address">Direccion</label>
        <input name="address" type="text" class="form-control" id="address" value="{{old('address')}}" placeholder="Calle tal no.12" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="postalcode">Codigo postal</label>
        <input name="postalcode" type="text" class="form-control" id="postalcode" value="{{old('postalcode')}}" placeholder="45330" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="bdate">Fecha de nacimiento</label>
        <input name="bdate" type="date" class="form-control" id="bdate" value="{{old('bdate')}}" placeholder="1990-12-01" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="state">Estado</label>
        <input name="state" type="text" class="form-control" id="state" value="{{old('state')}}" placeholder="Jalisco" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="career">Carrera</label>
        {!! Form::select('career_id',$careers,old('career_id'),['class'=>'custom-select form-control','required']) !!}
      </div>
    </div>
  <button class="btn btn-primary" type="submit">Registrar</button>
{!! Form::close() !!}
@endsection
@section('js')
  <script>
  sideitemactive(7);
  @if(Session::has('invalid'))
    $('#email').addClass('is-invalid');
  @endif
  </script>
@endsection
