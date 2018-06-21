{{-- personal students sistemas table --}}
@extends('templates.structure-personal')
@section('title','Alumnos Sistemas')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/paginationstyles.css') }}">
@endsection
@section('content')
  <h2>Alumnos</h2>
  <div class="row">
  {!! Form::open(['route'=>'indexstudents','method'=>'GET','class'=>'col-sm-auto form-inline']) !!}
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
            @foreach ($students as $student)
               <tr>
                  <th scope="row">{{$student->studentnip}}</th>
                  <td>{{$student->name}}</td>
                  <td>{{$student->lastname}}</td>
                  <td>{{$student->address}}</td>
                  <td>{{$student->postalcode}}</td>
                  <td>{{$student->phone}}</td>
                  <td>{{$student->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination" class="mx-auto" style="width: 200px;">
      {{$students->links()}}
    </div>
  </div>
@endsection
@section('js')
  <script>
    $(document).ready(function(){
      $('#pagination ul .active').addClass('pactive');
      $('#pagination ul .pactive').removeClass('active');
    });
  </script>
@endsection
