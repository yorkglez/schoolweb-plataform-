function active(item){
  var menu = $('.navbar-nav li');
  menu.removeClass('active');
  menu.eq(item).addClass('active');
}
