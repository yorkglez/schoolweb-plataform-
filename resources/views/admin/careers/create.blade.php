@extends('templates.structure-admin')
@section('title','Nueva carrera')
@section('css')
@endsection
@section('content')
	<h2>Nueva Carrera</h2>
	{!! Form::open(['route'=>'careers.store','method'=>'POST']) !!}
		<div class="form-row">
			<div class="form-group col-md-2">
				<label for="code">Clave de carrera: </label>
				<input id="code" class="form-control" name="code" type="text">
				<div class="invalid-feedback">
					La clave de la carrera ya existe
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="name">Nombre de carrera:</label>
				<input required class="form-control" name="name" value="{{ old('name') }}" type="text">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="name">Alias:</label>
				<input required class="form-control" value="{{ old('alias') }}"  name="alias" type="text">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<label for="semesters">No de semestres:</label>
				<input required class="form-control" value="{{ old('semesters') }}" name="semesters" type="number">
			</div>
		</div>
		<button  class="btn btn-success" type="submit">Guardar</button>
	{!! Form::close() !!}
@endsection
@section('js')
	<script>
		sideitemactive(6);
	@if(Session::has('inuse'))
		$('#code').addClass('is-invalid');
	@endif
	</script>
@endsection
