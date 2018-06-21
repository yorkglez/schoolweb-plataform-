var list = [];
var count = 0;
// chosen config
$('.chosen').chosen({
  no_results_text: "Oops, No se encontro resultado!",
  placeholder_text_single: "Seleeccione una opcion"
});
$('#btn-add').on('click', function(){
  var day =  $('#day').val();
  var starttime = $('#starttime').val();
  var endtime = $('#endtime').val();
  var row = {count, day, starttime, endtime};
  list.push(row);
  if (!$('.table-container').is('visible'))
    $('.table-container').css('display','block');
  $('tbody').append('<tr data-value ="'+count+'"><th scope="row">'+$("#day option:selected").text()+'</th><td>'+starttime+'</td><td>'+endtime+'</td><td><button class="delete btn btn-danger">Eliminar</button></td><tr>');
  count++;
  $('#starttime').val('');
  $('#endtime').val('');
});
$('tbody').on('click','.delete',function(){
  var row = $(this).parent().parent();
  var index = row.attr('data-value')
  $.each(list, function(i, val) {
    if(val['count'] == index){
      index = i;
      return false;
    }
  });
  list.splice(index,1)
  row.remove();
  // console.log(list);
});
