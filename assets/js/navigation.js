// Onload functions
$(document).ready(function(){
  // Init Slideout Menu
  $(".button-collapse").sideNav();
});

// Add class to header on scroll
var scrollPosition = function(){
  var scrollIsTop = $(window).scrollTop();
  if(scrollIsTop <= 60){
    $('.navbar-fixed').removeClass('notransparency');
    $('.navbar-fixed').addClass('transparency');
  }
  else{
    $('.navbar-fixed').removeClass('transparency');
    $('.navbar-fixed').addClass('notransparency');
  }
}
$(window).on('scroll', scrollPosition);


// Viewport height containers
