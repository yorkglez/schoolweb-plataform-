$('#btn-new').on('click', function(){
  $('.popup-container').css('display','block');
  $('.standars2').remove();
  $('#standars').clone().addClass('standars2').insertAfter( ".st div label" );
});
$('.chosen').chosen({
  no_results_text: "Oops, No se encontro resultado!",
  placeholder_text_multiple: "Seleeccione una opcion"
});
$('#subject_code').on('click', function(){
  $('#students option').remove();
});
