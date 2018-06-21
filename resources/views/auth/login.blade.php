@extends('auth.structurelogin')
@section('title','Log')
@section('form')
  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
       @include('auth.inputlogin')
  </form>
@endsection
@section('js')
  <script>
    $('.l3').addClass('active');
  </script>
@endsection
