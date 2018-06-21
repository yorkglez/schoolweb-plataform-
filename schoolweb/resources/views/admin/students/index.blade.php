
{{-- index Students --}}
@extends('templates.structure-admin')
@section('title','Alumnos')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/paginationstyles.css') }}">
  	<style>
  		.table-container{
  			/*max-width: 1200px;*/
  		}
  	</style>
@endsection
@section('content')
	<div class="table-container">
    <h2>Alumnos</h2>
  <div class="form-inline">
  {!! Form::open(['method'=>'GET','route'=>'students.index','class'=>'mr-sm-2'])!!}
      <input class="form-control mr-sm-2" type="search" placeholder="Nombre, nip" name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Buscar</button>
  {!!Form::close()!!}
  {!! Form::open(['method'=>'GET','route'=>'students.index','class'=>'mr-sm-2'])!!}
      <select class="form-control custom-select mb-2 mr-sm-2 mb-sm-0" name="status" onchange="this.form.submit()">
        <option selected>Mostrar por...</option>
        <option value="activo">Activos</option>
        <option value="baja temporal">Baja temporal</option>
        <option value="baja">Baja</option>
      </select>
  {!!Form::close()!!}
  </div>
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
          <th scope="col">Nip</th>
          <th scope="col">Nombre</th>
          <th scope="col">Carrera</th>
          <th scope="col">Direccion</th>
          <th scope="col">Cp</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo</th>
          <th scope="col">Estado</th>
          <th scope="col">Accion</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($students as $student)
					<tr>
						<th scope="row">{{$student->studentnip}}</th>
						<td>{{$student->name.' '.$student->lastname}}</td>
            <td>{{$student->career->alias}}</td>
						<td>{{$student->address}}</td>
						<td>{{$student->postalcode}}</td>
						<td>{{$student->phone}}</td>
            <td>{{$student->email}}</td>
						<td>
               @if ($student->status =='activo')
                <span class="badge badge-primary">{{$student->status}}</span>
              @elseif ($student->status =='baja temporal')
                <span class="badge badge-warning">{{$student->status}}</span>
              @else
                <span class="badge badge-danger">{{$student->status}}</span>
              @endif
            </td>
						<td>
							<div class="form-inline">
								<div class="form-group mx-sm-3">
									{!! Form::open(['method'=>'GET','route'=>['students.edit',$student->studentnip]]) !!}
                    <input type="hidden" class="status" name="statuss">
                    <button type="submit" class="btnactive btn btn-success">
											<i class="fa fa-check" aria-hidden="true"></i>
										</button>
                    <button type="submit" class="btnoff btn btn-warning">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </button>
                    <button type="submit" class="btntemporal btn btn-danger">
                      <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
									{!! Form::close() !!}
								</div>
							</div>
						</td>
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
	<script src="{{ asset('js/pagination.js') }}"></script>
	<script src="{!! asset('js/admin/students.js') !!}"></script>
	<script>
		sideitemactive(4);
	</script>
@endsection
