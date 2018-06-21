sideitemactive(1);
var list = [];
var number = 0;
$('#btngenerate').on('click',function(e){
  e.preventDefault();
  number = $('#number').val();
  $('.table-container').css('display', 'block');
  for (var i = 0; i < number;i++) {
    $('tbody').append('<tr><th contenteditable="true" class="sname"></th><td contenteditable="true" class="value"></td></tr>');
  }
  $('#btnsave').css('display','block');
});
