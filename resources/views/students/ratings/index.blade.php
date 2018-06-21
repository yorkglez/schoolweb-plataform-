{{-- Ratings students index --}}
@extends('templates.structure')
@section('title','Calificaciones')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
@endsection
@section('content')
<div id="container">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	<h2 class="pagetitle">Calificaciones</h2>
	<br>
	  <div class="form-inline justify-content-md-center">
	    <div class="form-group">
	        <label>Seleccione ciclo escolar</label>
	        {!! Form::select('cicle',['A'=>'A','B'=>'B'],null, ['id'=>'cicle','class'=>'mx-sm-3 form-control']) !!}
	    </div>
	    <div class="mx-sm-3 form-group">
	        <label>Anio</label>
	        <input type="number" id="year" name="year" class="mx-sm-3 form-control" required placeholder="2017">
	    </div>
			<div class="form-group">
				<button class="form-control btn btn-primary"  type="button" id="btnload-sub">Cargar calificaciones</button>
			</div>
		</div>
    <br>
    <div class="table-container mx-auto" style="max-width: 600px">

		</div>
</div>
@endsection
@section('js')
	<script>
		active(1);
		$('#container').on('click','#btnload-sub',function(){
			var cicle = $('#cicle').val();
			var year = $('#year').val();
			if (year != '') {
				$.ajax({
						headers: {'X-CSRF-Token': $('input[name=_token]').val()},
						url: "{{ route('student.availablesubjects') }}",
						type: 'POST',
						dataType: 'json',
						data: {cicle: cicle, year: year},
						success: function(resp){
							if (resp.exists) {
								var count = 0;
								if($('.alert').length>0)
									$('.alert').remove();
								if($('table').length>0)
									$('table').remove();
									$('h4').remove();
								$.each(resp.$ratings, function(index,val){
									 $('.table-container').append('<h4>'+ index +'</h4><table class="table table-striped">'
										 +'<thead  class="thead-dark">'
											 +'<tr>'
											 +'<th scope="col">Modulo</th>'
											 +'<th scope="col">Calificacion</th>'
											 +'</tr>'
											 +'</thead>'
											 +'<tbody id="tb'+count+'">'
											 +'</tbody>'
											 +'</table>');
											 var total = 0;
									$.each(val, function(i,v){
											$('#container #tb'+count).append('<tr>'
														+'<th scope="row">'+v['module']+'</th>'
														+'<td>'+v['averange']+'</td>'
												+'</tr>'
											);
											total = (total +  parseFloat(v['averange']/parseInt(resp.tm[count])));
										console.log(v['module']);
									});
									$('#container #tb'+count).append('<tr>'
												+'<th scope="row">Promedio</th>'
												+'<td>'+total+'</td>'
										+'</tr>'
									);
									count++;
								});
							}
							else{
								if($('table').length>0)
									$('table').remove();
									$('h4').remove();
								if($('.alert').length>0)
									$('.alert').remove();
								$('#container').after('<div class="alert alert-info mx-auto" role="alert" style="max-width: 1250px">'
							  		+'Aun no tienes materias calificadas!'
									+'</div>');
							}
						}
				});
			}
			else{
				alert();
			}
		});
		$('#btnload').on('click',function(){
			var subject = $('#subjects').val();
			$.ajax({
					headers: {'X-CSRF-Token': $('input[name=_token]').val()},
					url: "{{ route('ratings.report') }}",
					type: 'POST',
					dataType: 'json',
					data: {subject: subject},
					success: function(resp){


					}
			});
		});
	</script>
@endsection
