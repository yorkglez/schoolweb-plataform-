{{-- create module teacher --}}
@extends('templates.structure-teacher')
@section('title','Nuevo modulo')
@section('css')
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<style media="screen">
		th,td,tr{
			border: 1px solid black;
		}
		.table-container{
			display: none;
		}
	</style>
@endsection
@section('content')
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	<h2>Crear nuevo modulo</h2>
	<div class="form-inline">
		<div class="form-group">
			<label>Materia: </label>
		</div>
 		<div class="form-group mx-sm-3">
    		{!! Form::select('subject_code',$subjectlist,null,['id'=>'subject_code','class'=>'custom-select mb-2 mr-sm-2 mb-sm-0','required']) !!}
  		</div>
	</div>
	<br>
	<form class="form-row">
		<div class="form-group">
			<label for="name">Nombre de unidad </label>
			<input name="name" type="text" class="form-control" id="name" placeholder="Module 1" required>
		</div>
		<div class="col-md-1 mx-sm-3">
			<label for="lastname">No de criterios</label>
			<input name="number" type="number" class="form-control" id="number" placeholder="1" required>
		</div>
		<div class="col-md-1 position-relative mb-3">
			<button type="submit" id="btngenerate" class="btn btn-primary position-relative" style="bottom: -30px;">Generar tabla</button>
		</div>
	</form>
	<div class="table-container group" style="width: 500px">
		<br>
		<table class="table table-responsive table-hover table-striped">
			<thead class="thead-dark">
			    <tr>
			      <th scope="col">Criterio</th>
			      <th scope="col">Porcentaje</th>
			    </tr>
			</thead>
			<tbody id="tbody">
			</tbody>
		</table>
	</div>
	<button id="btnsave" class="btn btn-success" style="display:none;">Guardar</button>
@endsection
@section('js')
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	<script src="{{ asset('js/teacher/createmodules.js') }}"></script>
	<script>

		$('#btnsave').on('click', function(e){
			var mname = $('#name').val();
			var subjectcode = $('#subject_code').val();
			if (mname != '') {
				$('tbody tr').each(function(index, el) {
					var name = $(this).children('.sname').text();
					var value = $(this).children('td').text();
					var row = {name,value};
					list.push(row);
				});
				$.ajax({
					headers: {'X-CSRF-Token': $('input[name=_token]').val()},
					url: "{{ route('modules.store') }}",
					type: 'POST',
					dataType: 'json',
					data: {list: list,subjectcode: subjectcode,name: mname},
					success: function(resp){
						toastr["success"](resp.message,'Success')
						window.setTimeout('location.reload()',1000);
					}
				});
			}
		});
	</script>
@endsection
