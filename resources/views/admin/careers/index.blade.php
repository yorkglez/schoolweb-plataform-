{{-- create career --}}
@extends('templates.structure-admin')
@section('title','Carreras')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/paginationstyles.css') }}">
  	<style>
  		.table-container{
  			max-width: 950px;
  		}
  	</style>
@endsection
@section('content')


	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	<div class="modal fade" id="Modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="name">Clave:</label>
						<input required class="form-control" name="idcareer" id="id" type="text">
					</div>
					<div class="form-group col-md-12">
						<label for="name">Nombre de carrera:</label>
						<input required class="form-control" name="name" id="name" type="text">
					</div>
					<div class="form-group col-md-12">
						<label for="name">Alias:</label>
						<input required class="form-control" name="alias" id="alias" type="text">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="semesters">No de semestres:</label>
						<input required class="form-control" name="semesters" id="semesters" type="number">
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnclose" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="btnsave" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
	<div class="table-container">
		<h2>Carreras</h2>
		<div class="form-inline">
			{!! Form::open(['method'=>'GET','route'=>'careers.index','class'=>'mr-sm-2'])!!}
					<input class="form-control mr-sm-2" type="search" placeholder="Nombre, id" name="search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-2" type="submit">Buscar</button>
			{!!Form::close()!!}
		</div>
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Clave de carrera</th>
					<th scope="col">Nombre</th>
					<th scope="col">Semestres</th>
					<th scope="col">Alias</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($careers as $career)
					<tr>
						<th class="th-idcareer" scope="row">{{$career->idcareer}}</th>
						<td class="td-name">{{$career->name}}</td>
						<td class="td-semesters">{{$career->semesters}}</td>
						<td class="td-alias">{{$career->alias}}</td>
						<td>
							<div class="form-inline">
								<div class="form-group">
										<buttom data-toggle="modal" data-target="#Modaledit"  class="btnedit btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></buttom>
								</div>
								<div class="form-group mx-sm-3">
									{!! Form::open(['method'=>'DELETE','route'=>['careers.destroy',$career->idcareer]]) !!}
										<button type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro que deseas eliminarlo?')">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
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
		{{$careers->links()}}
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('js/pagination.js') }}"></script>
	<script src="{{ asset('js/admin/indexcareers.js') }}"></script>
	<script>
		sideitemactive(5);
		$('#btnsave').on('click', function() {
			var id =  $('#id').val();
			var name = $('#name').val();
			var alias = $('#alias').val();
			var semesters =  $('#semesters').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('admin.updatecareer') }}",
				type: 'POST',
				dataType: 'json',
				data: {id: id,name: name, alias: alias, semesters: semesters},
				success: function(resp){
					if(resp.update){
						location.reload();
					}
				}
			});
		});
	</script>
@endsection
