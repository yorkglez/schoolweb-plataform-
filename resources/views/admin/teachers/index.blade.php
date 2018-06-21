
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
    <h2>Maestros</h2>
  <div class="form-inline">
	  {!! Form::open(['method'=>'GET','route'=>'admin.teachers','class'=>'mr-sm-2'])!!}
	      <input class="form-control mr-sm-2" type="search" placeholder="Nombre, nip" name="search" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Buscar</button>
	  {!!Form::close()!!}
  </div>
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
          <th scope="col">Nip</th>
          <th scope="col">Nombre</th>
          <th scope="col">Cp</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo</th>
          <th scope="col">Estado</th>
          <th scope="col">Accion</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($teachers as $teacher)
					<tr>
						<th scope="row">{{$teacher->teachernip}}</th>
						<td>{{$teacher->name.' '.$teacher->lastname}}</td>
						<td>{{$teacher->postalcode}}</td>
						<td>{{$teacher->phone}}</td>
            <td>{{$teacher->email}}</td>
						<td>
               @if ($teacher->status =='activo')
                <span class="badge badge-primary">{{$teacher->status}}</span>
              @else
                <span class="badge badge-danger">{{$teacher->status}}</span>
              @endif
            </td>
						<td>
							<div class="form-inline">
								<div class="form-group mx-sm-3">
									{!! Form::open(['method'=>'GET','route'=>['admin.teachersstatus',$teacher->teachernip]]) !!}
                    <input type="hidden" class="status" name="statuss" value="">
                    <button id="" type="submit" class="btnactive btn btn-success">
											<i class="fa fa-check" aria-hidden="true"></i>
										</button>
                    <button  type="submit" class="btnoff btn btn-warning">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
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
		    {{$teachers->links()}}
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('js/pagination.js') }}"></script>
	<script src="{{ asset('js/admin/teachers.js') }}"></script>
	@section('js')
		<script>
			sideitemactive(3);
		</script>
	@endsection
@endsection
