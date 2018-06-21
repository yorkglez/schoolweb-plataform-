{{-- create subjectslist --}}
@extends('templates.structure-admin')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
	<style media="screen">
		.table-container{
			display: none;
		}
	</style>
@endsection
@section('content')
	<h2>Asignar materias</h2>
<form>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	<div class="row">
		<div class="col-md-4 mb-3">
        <label for="teacher_nip">Maestro</label>
        {!! Form::select('teacher_nip',$teachers,null,['class'=>'form-control chosen','required',]) !!}
    </div>
  	<div class="col-md-4 mb-3">
        <label for="subject_code">Seleccionar materia</label>
        {!! Form::select('subject_code',$subjects,null,['class'=>'form-control chosen','required']) !!}
  	</div>
	</div>
	<div class="row">
		<div class="col-md-4 mb-3">
	        <label for="career_id">Carreera</label>
	        {!! Form::select('career_id',$careers,null,['class'=>'form-control chosen','required']) !!}
        </div>
				<div class="col-md-4 mb-3">
	        <label for="semester">Semestre</label>
	        <input type="text" required class="form-control" name="semester" placeholder="1">
        </div>
	</div>
</form>
	<div class="row">
		<div class="col-md-4 mb-3">
			<h4>Creear horario para la materia</h4>
		</div>
		<div class="col-md-4 mb-3">
			<h5>Utiliza el formato de 24 horas</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 mb-3">
	        <label for="day">Dia</label>
	        {!! Form::select('day',['Monday'=>'Lunes','Tuesday'=>'Martes','Wednesday'=>'Miercoles','Thursday'=>'Jueves','Friday'=>'Viernes'],null,['class'=>'form-control','required','id'=>'day']) !!}
        </div>
        <div class="col-md-2 mb-3">
	        <label for="start_time">Hora de entrada</label>
	        <input id="starttime" class="form-control" type="text" name="start_time" placeholder="7:00">
        </div>
            <div class="col-md-2 mb-3">
	        <label for="end_time">Hora de salida</label>
	        <input  id="endtime" class="form-control" type="text" name="end_time" placeholder="7:50">
        </div>
		<div class="col-md-2 mb-3" style="position: relative;">
			<button id="btn-add" type="submit" class="btn btn-success" style="position: relative; bottom: -30px;">Agregar</button>
		</div>
	</div>
	<button id="btn-send" type="submit" class="btn btn-primary position-relative" style="bottom: -30px; margin-bottom: 10px;">Guardar</button>
	<br>
	<div class="table-responsive table-container" style="max-width: 500px">
		<br>
      <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
              <th scope="col">Dia</th>
              <th scope="col">Hora de entrada</th>
              <th scope="col">Hora de salida</th>
              <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>
  </div>
@endsection
@section('js')
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	<script src="{{ asset('js/admin/subjectslistcreate.js') }}"></script>
	<script>
		sideitemactive(9);
		$('#btn-send').on('click', function(){
			ajax();
		});
		function ajax(){
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('storesubjectlist') }}",
				type: 'POST',
				dataType: 'json',
				data: {teacher_teachernip: $("select[name='teacher_nip']").val(),
				career_idcareer: $("select[name='career_id']" ).val(),
				subject_code: $("select[name='subject_code']" ).val(),
				semester: $("input[name='semester']" ).val()
				,list: list},
				success: function(resp){
					list = [];
					$('tbody tr').remove();
					toastr["success"](resp.message,'Success')
				}

			});
		}
	</script>
@endsection
