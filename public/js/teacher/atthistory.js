var list =[];
var code = null;
$('#subject_code').on('change', function(){
  $('#btnload').removeAttr('disabled');
});
$('tbody').on('click', '.btnedit',function() {
  code = $(this).parents('tr').attr('code');
  type = $(this).parents('tr').children('.atype').text();
  $('#type').val(type);
});
