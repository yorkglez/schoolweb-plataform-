{{-- create ratings teacher --}}
@extends('templates.structure-teacher')
@section('title','Nuevo modulo')
@section('css')
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
	<style type="text/css" media="screen">

	</style>
@endsection
@section('content')
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	<h2>Generar calificaciones</h2>
	<div class="form-row">
		<div class="col-auto">
			<label>Selecciona una materia</label>
			{!! Form::select('subjects',$listsubjects,null, ['id'=>'subjects','class'=>'form-control']) !!}
		</div>
		<div class="col-auto">
			<label>Modulo</label>
			{!! Form::select('modules',[],null, ['id'=>'modules','class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-row">
		<div class="col-auto">
			<label>Seleccionar alumnos</label>
			{!! Form::select('students[]',[],null, ['id'=>'students','class'=>' form-control']) !!}
		</div>
		<div class="col-auto position-relative md-2">
			<button type="button" id="btngenerate" class="position-relative btn btn-primary" style="bottom: -30px;">Generar calificaciones</button>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script>
		sideitemactive(2);
		$('#modules').on('change', function(){
			var module = $(this).val();
			var subject = $('#subjects').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('ratings.studentlist') }}",
				type: 'POST',
				dataType: 'json',
				data: {subject: subject,module: module },
				success: function(resp){
					$('#students option').remove();
					var option = new Option('----','null');
					$('#students').append(option);
					$.each(resp.students, function(index,val) {
						//$('#students').prop('options');
						var option = new Option(val,index);
						$('#students').append(option);
						// $('#students').append("<option value = '" + index + "'>" + val + "</option>");
					});
				}
			});
		});
		$('#subjects').on('change', function(){
			var subject = $(this).val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				data: {subject: subject},
				url: "{{ route('ratings.getmodules') }}",
				type: 'POST',
				dataType: 'json',
				success: function(resp){
					$('#modules option').remove();
					var option = new Option('----','null');
					$('#modules').append(option);
					$.each(resp.modules, function(index,val) {
						var option = new Option(val,index);
						$('#modules').append(option);
					});
				}
			});
		});
		$('#btngenerate').on('click', function(){
			var module = $('#modules').val();
			var student = $('#students').val();
			if (module != 'null' && student !='null') {
				$.ajax({
					headers: {'X-CSRF-Token': $('input[name=_token]').val()},
					url: "{{ route('ratings.store') }}",
					type: 'POST',
					dataType: 'json',
					data: {module: module,student: student},
					success: function(resp){
						if (resp.store)
							toastr["success"]('Se a calificado exitosamente!','Success')

					}
				});
			}
		});


	</script>
@endsection
