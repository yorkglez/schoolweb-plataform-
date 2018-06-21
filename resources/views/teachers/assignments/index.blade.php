{{-- assignaments teacxher --}}
@extends('templates.structure-teacher')
@section('title','Registro de trabajos')
@section('css')
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
	<style>
		.modules-group{
			display: none;
		}
		.student-container{
			display: none;
		}
		.popup-container{
			display: none;
		}
	</style>
@endsection
@section('content')
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	<h2>Registro de trabajos</h2>
<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nuevo trabajo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
					<div class="col-md-12">
					<label>Nombre del trabajo:</label>
					<input type="text" name="assignmentname" placeholder="Tabajo 1" class="form-control">
					</div>
					</div>
					<br>
					<div class="st row">
					<div class=" col-md-12">
					<label class="" for="standars2">Seleccionar encuadre: </label>
					</div>
					</div>
					<br>
					<button data-toggle="modal" type="button" id="btnsaveassig" class="btn btn-primary">Guardar</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<div id="formsubject" class="form-row">
		<div class="col-auto">
			<label  for="subject_code">Seleccionar materia: </label>
			{!! Form::select('subject_code',$subjectlist,'null',['id'=>'subject_code','class'=>'form-control','required']) !!}
		</div>
		<div class="col-auto modules-group">
			<label id="lblmodules" for="module"> Seleccionar unidad: </label>
			{!! Form::select('module',[],null,['id'=>'modules','class'=>' form-control','required']) !!}
		</div>
		{{-- <button id="btnload" type="button" class="modules-group btn btn-primary">Cargar lista</button> --}}
	</div>
	<br>
	<div class="student-container form-row">
		<div class="col-auto">
			<label for="student">Seleccionar alumnos: </label>
			{!! Form::select('students',[],null,['id'=>'students','class'=>'form-control','required']) !!}
		</div>
		<div class="col-auto">
			<label for="standars">Seleccionar encuadre: </label>
			{!! Form::select('standars',[],null,['id'=>'standars','class'=>' form-control','required']) !!}
		</div>
	</div>
	<div class="student-container form-row">
		<div class="col-auto">
			<label for="assignament">Seleccionar trabajo: </label>
			{!! Form::select('assignaments',[],null,['id'=>'assignaments','class'=>' form-control','required']) !!}
		</div>
		<div class="col-auto" style="position: relative;">
			<button  data-toggle="modal" data-target="#exampleModal" id="btn-new" type="button" class="btn btn-success" style="position: relative; bottom: -30px;">Nuevo</button>
		</div>
		<div class="col-auto">
			<label>Calificacion:</label>
			<input id="score" type="number" class="form-control">
		</div>
		<div class="col-md-auto position-relative">
			<button type="button" id="btn-score" class="btn btn-primary position-relative" style="bottom: -30px ">Calificar</button>
		</div>
	</div>
	<br>
	<div class="popup-container" >
		<form class="popup-content">

		</form>
	</div>
@endsection
@section('js')
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	<script src="{{asset('js/teacher/assignments.js')}}" type="text/javascript"></script>
	<script>
		sideitemactive(3);
		$('#btnsaveassig').on('click', function(){
			var name = $('input[name=assignmentname]').val();
			var standar = $('.standars2').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('assignaments.store') }}",
				type: 'POST',
				dataType: 'json',
				data: {name: name,standar: standar},
				success: function(resp){
					if (resp.store) {
						toastr["success"]('Asignaccion guardada exitosamente!','Success')
						$('input[name=assignmentname]').val('');
						//var option = new Option(resp.assignment['name'],resp.assignment['idassignment']);
						//$('#assignaments').append(option);
					}
				}
			});
		});
		$('#btn-score').on('click', function(){
			var score = $('#score').val();
			var student = $('#students').val();
			var assignament = $('#assignaments').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('assignaments.storescore') }}",
				type: 'POST',
				dataType: 'json',
				data: {score: score,student: student, assignament: assignament},
				success: function(resp){
					if (resp.store) {
						$('#score').val('');
						toastr["success"]('Se a calificado exitosamente!','Success')
					}
				}
			});
		});

		$('#subject_code').on('change',function(){
			var subject = $(this).val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('moduleslist') }}",
				type: 'POST',
				dataType: 'json',
				data: {subject: subject },
				success: function(resp){
					$('#standars option').remove();
					$('#assignaments option').remove();
					$('#modules option').remove();
					var option = new Option('----','null');
					$('#students').append(option);
					$.each(resp.students, function(index,val) {
						var option = new Option(val['name'],val['idsubject']);
						$('#students').append(option);
					});
					if (resp.exists) {
						var option = new Option('----','null');
						$('#modules').append(option);
						$.each(resp.modules, function(index, val) {
							var option = new Option(val,index);
							$('#modules').append(option);
						});
						$('.modules-group').toggle();
					}else{
						var option = new Option('No hay modulos disponibles','null');
						$('#modules').append(option);
					}
				}
			});
		});

		$('#modules').on('change', function(){
			var subject = $('#subject_code').val();
			var module = $('#modules').val();
			$.ajax({
			headers: {'X-CSRF-Token': $('input[name=_token]').val()},
			url: "{{ route('standars.showstandars') }}",
			type: 'POST',
			dataType: 'json',
			data: {module: module,subject: subject },
			success: function(resp){
				if (resp.exists) {
					if($('#standars option').length>0)
						$('#standars option').remove();
					$.each(resp.standars, function(index, val) {
						var option = new Option(val,index);
						$('#standars').append(option);
					});
				}
				$('.student-container').css('display','flex');
			}
			});
		});
		$('#standars').on('change', function(){
	 		var standar = $(this).val();
	 		$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('assignmentslist') }}",
				type: 'POST',
				dataType: 'json',
				data: {standar: standar},
				success: function(resp){
					if($('#assignaments option').length>0)
						$('#assignaments option').remove();
					if (resp.exists){
						$.each(resp.assignments, function(index, val) {
							var option = new Option(val,index);
							$('#assignaments').append(option);
						});
					}
				}
			});
		});
	</script>
@endsection
