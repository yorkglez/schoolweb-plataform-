function sideitemactive(item){
  var side = $('.sidebar-nav li');
  side.removeClass('active');
  side.eq(item).addClass('active');
}
