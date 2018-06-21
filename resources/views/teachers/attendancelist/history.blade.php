@extends('templates.structure-teacher')
@section('title','Historial de asistencias')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/icheck/skins/all.css"') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/radiostyles.css') }}">
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<style>
		#btnsave{
			display: none;
		}
		.table-container{
			display: none;
			max-width: 900px;
		}
		.togtb{
			display: block;
		}
		#btnload{
			margin-bottom: 15px;
		}
	</style>
@endsection
@section('content')
	<h2>Historial de asistencias</h2>
	<br>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar asistencia</h5>
        <button id="btnchange" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="custom-select" id="type">
        	<option value="presente">Peresnte</option>
        	<option value="retardo">Retardo</option>
        	<option value="ausente">Ausente</option>
        	<option value="justificado">Justificado</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button  type="button" class="btnsave btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
	<div class="form-row">
		<div class="col-auto">
			<label  for="subject_code">Seleccionar materia: </label>
			{!! Form::select('subject_code',$subjectlist,null,['id'=>'subject_code','class'=>'form-control','required']) !!}
		</div>
		<div class="col-auto">
			<label for="date">Seleccionar dia: </label>
			<input class="form-control" value="{{Carbon\Carbon::now()->toDateString()}}"  type="date" name="date" id="date" placeholder="">
		</div>
		<div class="col-auto postion-relative">
			<button id="btnload"  type="button" class="btn btn-primary position-relative" style="bottom: -30px">Cargar lista</button>
		</div>
	</div>
	<br>
	<div class="from-line">

	</div>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	<div class="table-container table-responsive">
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No de control</th>
					<th scope="col">Nombre</th>
					<th scope="col">Tipo de asistencia</th>
					<th scope="col">Accion</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<button type="button" id="btnsave" class="btn btn-success">Guardar</button>
@endsection
@section('js')
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{asset('js\toastrconfig.js')}}" type="text/javascript"></script>
	<script src="{{asset('js\teacher\atthistory.js')}}" type="text/javascript"></script>
	<script>
		sideitemactive(5);
		$('#btnload').on('click', function() {
			$('tbody tr').remove();
			var code = $('#subject_code').val();
			var date = $('#date').val();
			var module = $('#module').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('attendancelist.showhistory') }}",
				type: 'POST',
				dataType: 'json',
				data: {code: code, date: date,module: module},
				success: function(resp){
					if (resp.exists) {
						if($('.alert').length>0)
							$('.alert').remove();
						if($('tbody tr').length>0)
							$('.tbody tr').remove();
						$('.table-container').css('display','block');
						$.each(resp.list, function(index,value){
							var badge = '';
							if (resp.list[index]['type'] =='presente')
								badge  ='success';
							if (resp.list[index]['type'] =='retardo')
								badge ='warning';
							if (resp.list[index]['type'] =='ausente')
								badge ='danger';
							if (resp.list[index]['type'] =='justificado')
								badge ='primary';
							$('tbody').append('<tr code="'+resp.list[index]['idattendance']+'">'
							+'<td>'+resp.list[index]['nip']+'</td><td>'+resp.list[index]['name']+'</td>'
							+'<td class="atype"><span class="badge badge-pill badge-'+badge+'">'+resp.list[index]['type']+'</span></td>'
							+'<td><button data-toggle="modal" data-target="#exampleModal" class="btnedit btn btn-warning" ><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
							});
							$('#btnload').attr('disabled', 'true');
						}
						else{
							if ($('.table-container').is(':visible'))
								$('.table-container').css('display','none');
							if($('.alert').length>0)
								$('.alert').remove();
							$('.table-container').before('<div class="alert alert-info" role="alert">'
  						+'<b>Sin resultados</b> '
							+' No se ha encontrado historial de asistencias.</div>');
						}
					}
				});

		});

		$('.btnsave').on('click',function() {
			var type = $('#type').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('attendancelist.attupdate') }}",
				type: 'POST',
				dataType: 'json',
				data: {code: code, type: type},
				success: function(resp){
					$('#exampleModal').modal('hide')
					if (resp.update)
						toastr["success"]('Asistencia actualizada!, los cambios seran reflejados cuando refresques la pagina','Success')
					else
						toastr["error"]('Ocurrio un error al actualizar!','Error:(')
				}
			});
		});
	</script>
@endsection
