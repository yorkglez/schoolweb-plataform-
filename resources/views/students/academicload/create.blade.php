{{-- academic load students --}}
@extends('templates.structure')
@section('title','Carga horaria')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('css/schedulestyles.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('css/academicloadstyles.css') }}">
@endsection
@section('content')
	@if ($loadexists)
		<div class="alert alert-info" role="alert">
			<h4 class="alert-heading">Ya has enviado tu carga academica!</h4>
			<p>Si tienes algun problema con tu carga horaria, consulta a tu jefe de carrera.</p>
			<hr>
		</div>
		@else
			<h2>Carga horaria</h2>
			<div id="loadcontainer">
				<div id="select-semester" class="form-inline">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
					<div class="form-group">
						<label>Semestre solicitado:</label>
					</div>
			 		<div class="form-group mx-sm-3">
			    		<select id="semester" class="form-control">
			    			<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
			    		</select>
			  		</div>
		  			<button type="button" id="btnload" class="btn btn-primary">Cargar materias</button>
				</div>
				{{-- <div id="alert-t1" class="alert alert-warning" role="alert">
				  <h4 class="alert-heading">Ya has cursado este semestre</h4>
				  <p>Selecciona un semestre valido :/</p>
				  <hr>
				</div> --}}
				<h3>Oferta academica</h3>
				<div class="table-container">
					<table class="table table-sm table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Clave</th>
								<th scope="col">Nombre</th>
								<th scope="col">Creditos</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="tags-container">
					<h4>Materias agregadas a tu carga horaria</h4>
					<div class="form-inline">
					</div>
				</div>
				<div id="error1" class="alert alert-danger" role="alert" style="display: none;">
		 			Debes agregar materias a tu carga horaria para poder enviarla
				</div>
				<br>
				<button id="btnsend" type="button" class="btn btn-primary">Enviar carga horaria</button>
			</div>
	@endif
@endsection
@section('js')
	<script src="{{ asset('js/student/academicload.js') }}" ></script>
	<script>
	 active(4);	
		$('#btnsend').on('click',function(){
			if($('.tags-container div').children().length>0){
				var list = [];
				var code = '';
				var semester = $('#semester').val();
				$('.tags-container span').each(function(index, el) {
					code = $(this).attr('code');
					list.push(code);
				});
				$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('academicload.store') }}",
				type: 'POST',
				dataType: 'json',
				data: {subjects: list,semester: semester },
				success: function(resp){
					if (resp.save) {
						$('#loadcontainer').remove();
						$('h2').after('<div id="loadsuccess" class="alert alert-success" role="alert">La carga hoaria ha sido enviada correctamente!</div>');
					}
				}
			});
			}
			else
				$('#error1').css('display', 'block');
		});

		$('#btnload').on('click', function(e){
			var semester = $('#semester').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('showsubjectsacload') }}",
				type: 'POST',
				dataType: 'json',
				data: {semester: semester},
				success: function(resp){
					if ($('#alert-t0').length>0)
						$('#alert-t0').remove();
					if (resp.exists) {
						$.each(resp.subjects, function(index, val) {
							$('tbody').append('<tr> <th code='+val['idsubject']+'>'+val['code']+'</th> <td class="sname">'+val['name']+'</td><td>'+val['credits']+'</td>'
							+'<td><button type="button" class="btnadd btn btn-success">Anadir</button></td></tr>');
						});
						$('#btnload').css('display','none');
					}
					else{
						$('#select-semester').after('<div id="alert-t0" class="alert alert-info" role="alert">'
						  +'<h4 class="alert-heading">Aun no hay materias registradas para este semestre</h4>'
						  +'<p>Por el momento no se encuentran materias disponibles, intentalo despues :)</p>'
						 +'<hr>'
						+'</div>');
					}
				}
			});
		});

	</script>
@endsection
