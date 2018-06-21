{{-- create subjectslist --}}
@extends('templates.structure-admin')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="{{asset('plugins/toastr/build/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
	<style media="screen">

	</style>
@endsection
@section('content')
	<h2>Asignar materias</h2>
<form>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	<div class="row">
		<div class="col-md-4 mb-3">
        <label for="teacher_nip">Maestro</label>
        {!! Form::select('teacher_nip',$teachers,$asig->teacher_teachernip,['class'=>'form-control chosen','required',]) !!}
    </div>
  	<div class="col-md-4 mb-3">
        <label for="subject_code">Seleccionar materia</label>
        {!! Form::select('subject_code',$subjects,$asig->subject_code,['class'=>'form-control chosen','required']) !!}
  	</div>
	</div>
	<div class="row">
		<div class="col-md-4 mb-3">
	        <label for="career_id">Carreera</label>
	        {!! Form::select('career_id',$careers,$asig->career_idcareer,['class'=>'form-control chosen','required']) !!}
        </div>
				<div class="col-md-4 mb-3">
	        <label for="semester">Semestre</label>
	        <input type="text" required class="form-control" name="semester"  value="{{ $asig->semester }}" placeholder="1">
        </div>
	</div>
</form>
	{{-- <div class="row">
		<div class="col-md-4 mb-3">
			<h4>Creear horario para la materia</h4>
		</div>
		<div class="col-md-4 mb-3">

		</div>
	</div> --}}
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
			<button id="btn-add" type="submit" class="btn btn-success" style="position: relative; bottom: -5px;">Agregar</button>
		</div>
	</div>
	<button id="btn-send" type="submit" class="btn btn-primary position-relative">Actualizar</button>
	<div class="table-responsive table-container" style="max-width: 500px; margin-top: 10px;">
      <table class="table table-hover table-striped">
        <h5>Utiliza el formato de 24 horas</h5>
        <thead class="thead-dark">
            <tr>
              <th scope="col">Dia</th>
              <th scope="col">Hora de entrada</th>
              <th scope="col">Hora de salida</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tbody">
          @foreach ($asig->schedule as $schedule)
            <tr>
              <input type="hidden" class="hid" value="{{ $schedule->idschedule }}">

                @if ($schedule->day=='Monday')
                  <th contenteditable class="tday">Lunes</th>
                @endif
                @if ($schedule->day=='Tuesday')
                  <th contenteditable class="tday">Martes</th>
                @endif
                @if ($schedule->day=='Wednesday')
                  <th contenteditable class="tday">Miercoles</th>
                @endif
                @if ($schedule->day=='Thursday')
                  <th contenteditable class="tday">Jueves</th>
                @endif
                @if ($schedule->day=='Friday')
                  <th contenteditable class="tday">Viernes</th>
                @endif

              <td contenteditable class="tst">{{$schedule->starttime}}</td>
              <td contenteditable class="tet">{{$schedule->endtime}}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
@endsection
@section('js')
	<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{asset('plugins/toastr/toastr.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/toastrconfig.js') }}"></script>
	{{-- <script src="{{ asset('js/admin/subjectslistcreate.js') }}"></script> --}}
	<script>
		sideitemactive(10);
    var slist = [];
    var count = 0;
		$('#btn-send').on('click', function(){
      $('tbody tr').each(function(index, el) {
        var id = $(this).children('.hid').val();
        if (id !=null) {
          var day = $(this).children('.tday').text().toLowerCase();
          if (day == 'lunes')
              day = "Monday";
          if (day == 'martes')
              day = 'Tuesday';
          if (day == 'miercoles')
              day = 'Wednesday';
          if (day == 'jueves')
              day = 'Thursday';
          if (day == 'viernes')
              day = 'Friday';
          var starttime = $(this).children('.tst').text();
          var endtime = $(this).children('.tet').text();
          var row = {id, day, starttime, endtime};
          slist.push(row);
        }
      });
      var idsubject = {{ $asig->idsubjectslist }};
      $.ajax({
        headers: {'X-CSRF-Token': $('input[name=_token]').val()},
        url: "{{ route('admin.updatelist') }}",
        type: 'POST',
        dataType: 'json',
        data: {teacher_teachernip: $("select[name='teacher_nip']").val(),
        career_idcareer: $("select[name='career_id']" ).val(),
        subject_code: $("select[name='subject_code']" ).val(),
        semester: $("input[name='semester']" ).val(),
        idsubject:idsubject,
        slist: slist},
        success: function(resp){
          if (resp.update) {
            window.location.replace("http://escolar.malastareas.com.mx/admin/subjectslistindex");
          }
        }
      });
  //    console.log(slist);
		  });
    $('tbody').on('click','.delete',function(){
      var row = $(this).parent().parent();
      var index = row.children('.hid').val();
      row.remove();
    });
    $('#btn-add').on('click', function(){
      var day =  $('#day').val();
      var starttime = $('#starttime').val();
      var endtime = $('#endtime').val();
      var id = count;
      $('tbody').append('<tr> <input type="hidden" class="hid" value="n'+id+'"><th class="tday" scope="row">'+$("#day option:selected").text()
      +'</th><td class="tst">'+starttime+'</td><td class="tet">'+endtime
      +'</td><td><button class="delete btn btn-danger">Eliminar</button></td><tr>');
      count++;
      $('#starttime').val('');
      $('#endtime').val('');
    });
	</script>
@endsection
