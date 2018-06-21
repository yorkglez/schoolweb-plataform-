$('.btnedit').on('click', function(){
  var code = $(this).parents('tr').children('.th-code').text();
  var name = $(this).parents('tr').children('.td-name').text();
  var credits = $(this).parents('tr').children('.td-credits').text();
  $('#code').val(code);
  $('#name').val(name);
  $('#credits').val(credits);
});
$('#btnclose').on('click',function(){
  $('#code').val('');
  $('#name').val('');
  $('#credits').val('');
});
