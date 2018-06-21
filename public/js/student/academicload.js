$('tbody').on('click','.btnadd', function(){
  var code = $(this).parents('tr').children('th').attr('code');
  var name = $(this).parents('tr').children('.sname').text();
  $('.tags-container div').append('<span class="tag badge badge-success" code="'+code+'" >'+name+'</span>');
  $(this).text('Eliminar');
  $(this).removeClass('btn-success');
  $(this).removeClass('btnadd');
  $(this).addClass('btn-danger');
  $(this).addClass('btndelete');
});
$('tbody').on('click','.btndelete', function(){
  var code = $(this).parents('tr').children('th').text();
  $('span[code="'+code+'"]').remove();
  $('.tags-container div').append('<span class="tag badge badge-success" code="'+code+'" >'+name+'</span>');
  $(this).text('Anadir');
  $(this).removeClass('btn-danger');
  $(this).removeClass('btndelete');
  $(this).addClass('btn-success');
  $(this).addClass('btnadd');
});
