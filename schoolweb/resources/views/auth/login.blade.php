@extends('auth.structurelogin')
@section('title','Login')
@section('form')
  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
       @include('auth.inputlogin')
  </form>
@endsection
@section('js')
  <script>
    $('.l3').addClass('active');
  </script>
@endsection
