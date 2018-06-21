$('#btnsidebar').on('click', function(event) {
  event.preventDefault();
  $('#wrapper').toggleClass("toggled");
  $('#sidebar-wrapper').toggle();
  $('#wrapper').removeClass("short");
});
$('#btnmside').on('click', function(event) {
  event.preventDefault();
  $('#wrapper').toggleClass("toggled");
  $('#sidebar-wrapper').toggle();
  $('#wrapper').removeClass("short");
});
$('#sidebar-wrapper').on('mouseleave', function(event) {
  event.preventDefault();
  $('#wrapper').addClass("short");
});
$('#sidebar-wrapper').on('click', function() {
  $('#wrapper').removeClass("short");
});
