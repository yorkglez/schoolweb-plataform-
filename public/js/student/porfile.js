var changepass = false;
$('#btnedit').on('click',function(){
  $('#name').attr('contenteditable','true');
  $('#lastname').attr('contenteditable','true');
  $('#phone').attr('contenteditable','true');
  $('#address').attr('contenteditable','true');
  $('#postalcode').attr('contenteditable','true');
  $('#email').attr('contenteditable','true');
  $('#bdate').attr('contenteditable','true');
  $('#btnsave').css('display','inline-block');
});
$('#btn-changepass').on('click',function(){
  $('.passwordcontainer').css('display', 'block');
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
$('#repeatpassword').on('mouseleave',function(){
  var password = $('#password').val();
  var repeatpassword = $('#repeatpassword').val();
  if (password != repeatpassword) {
    $('#error-pass').css('display','block');
  }else{
    changepass = true;
  }
});
$('#repeatpassword').on('click keypress keyup',function(){
  $('#error-pass').css('display','none');
  if($('.alert').length>0)
    $('.alert').remove();
});
$('#password').on('click keypress keyup',function(){
  $('#error-pass').css('display','none');
  if($('.alert').length>0)
    $('.alert').remove();
});
