@extends('auth.structurelogin')
@section('title','Login Maestros')
@section('form')
  <form class="form-horizontal" method="POST" action="{{ route('teacher.login.submit') }}">
    @include('auth.inputlogin')
  </form>
@endsection
@section('js')
	<script>
		$('.l2').addClass('active');
	</script>
@endsection

