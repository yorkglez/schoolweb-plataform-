{{-- Index teachers personal--}}
@extends('templates.structure-personal')
@section('title','Alumnos Sistemas')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/paginationstyles.css') }}">
@endsection
@section('content')
  <h2>Maestros</h2>
  <div class="row">
  {!! Form::open(['route'=>'indexteachers','method'=>'GET','class'=>'col-sm-auto form-inline']) !!}
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Burscar</button>
  {!! Form::close() !!}
  </div>
  <br>
	<div class="table-container">
      <table class="table table-sm table-striped">
        <thead class="thead-dark">
            <tr>
              <th scope="col">No de control</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Direccion</th>
              <th scope="col">Codigo postal</th>
              <th scope="col">Telefono</th>
              <th scope="col">Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
               <tr>
                  <th scope="row">{{$teacher->teachernip}}</th>
                  <td>{{$teacher->name}}</td>
                  <td>{{$teacher->lastname}}</td>
                  <td>{{$teacher->address}}</td>
                  <td>{{$teacher->postalcode}}</td>
                  <td>{{$teacher->phone}}</td>
                  <td>{{$teacher->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination" class="mx-auto" style="width: 200px;">
      {{$teachers->links()}}
    </div>
  </div>
@endsection
@section('js')
  <script src="{{ asset('js/pagination.js') }}"></script>
  <script>
    sideitemactive(6);
  </script>
@endsection
