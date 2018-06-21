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

// $('#btnsave').on('click', function() {
//   var id =  $('#id').val();
//   var name = $('#name').val();
//   var alias = $('#alias').val();
//   var semesters =  $('#semesters').val();
//   $.ajax({
//     headers: {'X-CSRF-Token': $('input[name=_token]').val()},
//     url: "{{ route('admin.updatecareer') }}",
//     type: 'POST',
//     dataType: 'json',
//     data: {id: id,name: name, alias: alias, semesters: semesters},
//     success: function(resp){
//       if(resp.update){
//         location.reload();
//       }
//     }
//   });
// });
