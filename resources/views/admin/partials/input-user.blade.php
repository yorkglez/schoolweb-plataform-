@extends('templates.structure-admin')
@section('title','New User')
@section('css')
  <style media="screen">
    /*#btnsave{
      display: none;
    }
    #cac1,#cac2,#error-pass{
      display: none;
    }
    #cac1,#cac2{
      color: orange;
    }
    #error-pass{
      color: red;
    }*/
  </style>
@endsection
@section('content')
  <h2>@yield('header')</h2>
@yield('form')
@endsection
{{-- @section('js')
  <script>
  $('#repeatpassword').on('mouseleave',function(){
    var password = $('#password').val();
    var repeatpassword = $('#repeatpassword').val();
    if(password.length>7 && repeatpassword.length>7){
      if (password != repeatpassword) {
        $('#error-pass').css('display','block');
      }
      else{
        $('#btnsave').css('display', 'block');
      }
    }
  });
  $('#password').on('keypress',function(){
    var count = $('#password').val().length;
    if (count<7)
      $('#cac1').css('display', 'block');
    else
      $('#cac1').css('display', 'none');
  });
  $('#repeatpassword').on('keypress',function(){
    var count = $('#repeatpassword').val().length;
    if (count<7)
      $('#cac2').css('display', 'block');
    else
      $('#cac2').css('display', 'none');
  });
  $('#repeatpassword').on('click keypress keyup',function(){
    $('#error-pass').css('display','none');
  });
  </script>` --}}
{{-- @endsection` --}}
