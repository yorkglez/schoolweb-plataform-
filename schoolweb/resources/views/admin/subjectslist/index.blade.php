{{-- create subjectslist --}}
@extends('templates.structure-admin')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
	<style media="screen">
    .table-container{
      max-width: 1000px;
    }
	</style>
@endsection
@section('content')
	<h2>Asignacciones</h2>
	<div class="table-responsive table-container">
    <div class="form-inline">
      {!! Form::open(['method'=>'GET','route'=>'admin.subjectslist','class'=>'mr-sm-2'])!!}
          <input class="form-control mr-sm-2" type="search" placeholder="Anio" name="search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Buscar</button>
      {!!Form::close()!!}
      {{-- subjectslist --}}
      {!! Form::open(['method'=>'GET','route'=>'admin.subjectslist','class'=>'mr-sm-2'])!!}
          <input type="hidden" name="actualcicle" value="true">
          <button class="btn btn-info my-2 my-sm-2" type="submit">Ciclo actual</button>
      {!!Form::close()!!}
    </div>
      <table class=" table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
              <th scope="col">Carrera</th>
              <th scope="col">Nombre</th>
              <th scope="col">Anio</th>
              <th scope="col">Ciclo</th>
              <th scope="col">Maestro</th>
              <th scope="col">Nip maestro</th>
              <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($subjects as $subject)
            <tr>
              <th>{{$subject->career->alias}}</th>
              <td>{{$subject->subject->name}}</td>
              <td>{{$subject->year}}</td>
              <td>{{$subject->period}}</td>
              <td>{{$subject->teacher->name.' '.$subject->teacher->name}}</td>
              <td>{{$subject->teacher->teachernip}}</td>
              <td>
                <div class="form-group">
                    <a class="btn btn-warning" href="{{route('subjectslist.edit',$subject->idsubjectslist)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
          @endforeach

        </tbody>
    </table>
  </div>
@endsection
@section('js')
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	<script>
		sideitemactive(10);

	</script>
@endsection
