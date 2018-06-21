{{-- Register teacher --}}
@extends('templates.structure-personal')
@section('title','Registrar maestro')
@section('css')

@endsection
@section('content')
  <h2>Registrar alumno</h2>
  {!! Form::open(['route'=>'storeteachers','method'=>'POST']) !!}
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="name">Nombre</label>
        <input name="name" type="text" class="form-control" value="{{old('name')}}" id="name" placeholder="Nombre" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="lastname">Apellidos</label>
        <input name="lastname" type="text" class="form-control" value="{{old('lastname')}}" id="lastname" placeholder="Apellidos" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="email">Correo</label>
        <input name="email" type="email" class="form-control" value="{{old('email')}}" id="email" placeholder="example@example.com" required>
        <div class="invalid-feedback">
					El correo ya esta en uso!
				</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="phone">Telefono</label>
        <input name="phone" type="tel" class="form-control" value="{{old('phone')}}" id="phone" placeholder="3841001234" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="address">Direccion</label>
        <input name="address" type="text" class="form-control" value="{{old('address')}}" id="address" placeholder="Calle tal no.12" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="postalcode">Codigo postal</label>
        <input name="postalcode" type="text" class="form-control" value="{{old('postalcode')}}" id="postalcode" placeholder="45330" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="bdate">Fecha de nacimiento</label>
        <input name="bdate" type="date" class="form-control" value="{{old('bdate')}}" id="bdate" placeholder="1990-12-01" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="state">Estado</label>
        <input name="state" type="text" class="form-control" value="{{old('state')}}" id="state" placeholder="Jalisco" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="specialism">Especialidad</label>
        <input name="specialism" type="text" class="form-control" value="{{old('specialism')}}" id="specialism" placeholder="Programaccion" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="degree">Grado de estudios</label>
        <input name="degree" type="text" class="form-control" value="{{old('degree')}}" id="degree" placeholder="Maestria" required>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">Registrar</button>
  {!! Form::close() !!}
@endsection
@section('js')
  <script>
  sideitemactive(8);
  @if(Session::has('invalid'))
    $('#email').addClass('is-invalid');
  @endif
  </script>
@endsection
