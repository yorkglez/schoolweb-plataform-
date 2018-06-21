{{-- create subjects admin --}}
@extends('templates.structure-admin')
@section('title','Nueva materia')
@section('content')
	<h2>Registrar nueva materia</h2>
	{!! Form::open(['route'=>'subjects.store','method'=>'POST']) !!}
		<div class="form-row">
			<div class="col-md-3">
				<label for="code">Clave:</label>
				<input class="form-control" type="text" id="code" value="{{old('code')}}" name="code" required>
				<div class="invalid-feedback">
					La clave de la carrera ya existe
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-3">
				<label for="name">Nombre:</label>
				<input class="form-control" type="text" value="{{old('name')}}" name="name" required>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-3">
				<label for="credits">Creditos:</label>
				<input class="form-control" type="number" value="{{old('credits')}}" name="credits" required>
			</div>
		</div>
		<br>
		<button type="submit" class="btn btn-success mx-auto">Guardar</button>
	{!! Form::close() !!}
@endsection
@section('js')
	<script>
		sideitemactive(8);
	@if(Session::has('inuse'))
		$('#code').addClass('is-invalid');
	@endif
	</script>
@endsection
