@extends('templates.structure-teacher')
@section('title','Control de asistencia')
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
			max-width: 900px;
			display: none;
		}
	</style>
@endsection
@section('content')
	<h2>Control de asistencias</h2>
	<br>
	<div id="formsubject" class="form-line">
		<label class="mr-sm-2" for="subject_code">Seleccionar materia: </label>
		{!! Form::select('subject_code',$subjectlist,null,['id'=>'subject_code','class'=>'custom-select mb-2 mr-sm-2 mb-sm-0','required']) !!}
		<label id="modules" class="mr-sd-2">Modulo</label>
		{!! Form::select('module',[],null,['id'=>'module','class'=>'custom-select mb-2 mr-sm-2 mb-sm-0','required']) !!}
		<button id="btnload"  type="button" class="btn btn-primary">Cargar lista</button>
	</div>
	<div class="from-line">
		<div class="form-check mb-2 mb-sm-0">
			 <label class="form-check-label">
				 <input class="form-check-input" id="allmodules" type="checkbox"> Tomar lista en todos los modulos
			 </label>
		 </div>
		<div class="form-check mb-2 mb-sm-0">
			 {{-- <label class="form-check-label">
				 <input class="form-check-input" id="allmodules" type="checkbox"> Tomar lista en todos los mudolos
			 </label> --}}
		 </div>
	</div>
	<br>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	{{-- <div id="options" class="form-line" style="display: none;">
		<button type="button" class="btn btn-success">Tomar asistencia</button>
		<button type="button" class="btn btn-primary">Ver lista de asistencia</button>
	</div> --}}
	<div class="table-container table-responsive">
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No control</th>
					<th scope="col">Alumno</th>
					<th scope="col">Presente</th>
					<th scope="col">Retardo</th>
					<th scope="col">Ausente</th>
					<th scope="col">Justificado</th>
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
	<script src="{{asset('js/teacher/attendancelistindex.js')}}" type="text/javascript"></script>
	<script>
		sideitemactive(4);
		$('#subject_code').on('change',function(){
			var module = $('#module').val();
			var subject = $('#subject_code').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('teacher.modulesofday') }}",
				type: 'POST',
				dataType: 'json',
				data: {module: module,subject: subject},
				success: function(resp){
					$.each(resp.modules,function(index, val) {
						$('#module').append(new Option(val, index));
					});
				}
			});

		});
		$('#btnload').on('click', function() {
			var code = $('#subject_code').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('showassistancelist') }}",
				type: 'POST',
				dataType: 'json',
				data: {code: code},
				success: function(resp){
					var count = 0;
					//alert($('tbody').leingh);
					if($('tbody').length > 0)
						$('tbody tr').remove();
					$('.table-container').css('display', 'block');
					$.each(resp.list,function(index,value) {
						$('tbody').append('<tr><td code="'+index+'">'+value['nip']+'</td><td>'+value['name']+'</td>'
							+'<td>'
								+'<div class="radio-item radio-success">'
	     							+'<input type="radio" id="r'+(count + 1)+'" name="'+index+'" value="1">'
	    							+'<label for="r'+(count + 1)+'"></label>'
								+'</div>'
							+'</td>'
							+'<td>'
								+'<div class="radio-item radio-warning">'
	     							+'<input type="radio" id="r'+(count + 2)+'" name="'+index+'" value="2">'
	    							+'<label for="r'+(count + 2)+'"></label>'
								+'</div>'
							+'</td>'
							+'<td>'
							+'<div class="radio-item radio-danger">'
     							+'<input type="radio" name="'+index+'" id="r'+(count + 3)+'" value="3">'
    							+'<label for="r'+(count + 3)+'"></label>'
							+'</div>'
							+'<td>'
							+'<div class="radio-item radio-primary">'
     							+'<input type="radio" name="'+index+'" id="r'+(count + 4)+'" value="4">'
    							+'<label for="r'+(count + 4)+'"></label>'
							+'</div>'
							+'</td>'
							+'</td>'
							+'</tr>');
							count = count + 4;
					});
					$('#btnsave').css('display','block');
					$('#btnload').attr('disabled', 'true');
				}
			});
		});
		$('#btnsave').on('click', function(event) {
			$('tbody tr').each(function(index, el) {
				var code = $(this).children().attr('code');
				var attendance = $('input[name='+code+']:checked').val();
				if (attendance != null) {
					var row = {code,attendance};
					list.push(row);
				}
			});
			var allmodules = $('#allmodules').is(':checked');
			if(allmodules)
				 allmodules = $('#module option').length;
			var subject = $('#subject_code').val();
			var module = $('#module').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('storeassistancelist') }}",
				type: 'POST',
				dataType: 'json',
				data: {list: list,subject: subject, module: module,allmodules: allmodules},
				success: function(resp){
					$('#btnsave').css('display', 'none');
					list = []
					$('tbody tr').remove();
					toastr["success"](resp.message,'Success')
				}
			});
		});
	</script>
@endsection
