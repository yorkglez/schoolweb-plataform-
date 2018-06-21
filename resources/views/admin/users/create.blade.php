@extends('admin.partials.input-user')
@section('header','Nuevo usuario')
@section('form')
  {!!Form::open(array('method' => 'POST', 'route' => 'users.store'))!!}
    <div class="form-row">
      <div class="col-md-3">
        <label>Nombre</label>
        <input required type="text" name="name" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Apellidos</label>
        <input required type="text" name="lastname" class="form-control">
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3">
        <label>Email:</label>
        <input required type="email" name="email" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Telefono:</label>
        <input required type="tel" name="phone" class="form-control">
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3">
        <label>Contrasena:</label>
        <input  minlength="8" maxlength="60" type="password" id="password" name="password" class="form-control" placeholder="Minimo 8 caracteres ">
      </div>
      <div class="col-md-3">
        <label>Tipo de usuario</label>
        <select class="form-control" name="type">
          <option value="admin">Administrador</option>
          <option value="personal">Personal</option>
        </select>
      </div>
    </div>
    <br>
    <button id="btnsave" type="submit" class="btn btn-success">Guardar</button>
  {!!Form::close()!!}
@endsection
@section('js')
  <script>
    sideitemactive(1);
  </script>
@endsection
