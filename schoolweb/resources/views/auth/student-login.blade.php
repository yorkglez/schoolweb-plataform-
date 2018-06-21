@extends('auth.structurelogin')
@section('title','Login Alumnos')

@section('form')
  <form class="form-horizontal" method="POST" action="{{ route('student.login.submit') }}">
    @include('auth.inputlogin')
    {{-- @section('type','Alumno') --}}
  </form>
@endsection
@section('js')
	<script>
		$('.l1').addClass('active');
	</script>
@endsection
