$('.btnedit').on('click', function(){
  var id = $(this).parents('tr').children('.th-idcareer').text();
  var name = $(this).parents('tr').children('.td-name').text();
  var alias = $(this).parents('tr').children('.td-alias').text();
  var semesters = $(this).parents('tr').children('.td-semesters').text();
  $('#id').val(id);
  $('#name').val(name);
  $('#alias').val(alias);
  $('#semesters').val(semesters);
});
$('#btnclose').on('click',function(){
  $('#id').val('');
  $('#name').val('');
  $('#alias').val('');
  $('#semesters').val('');
});
