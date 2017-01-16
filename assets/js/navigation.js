// Onload functions
$(document).ready(function(){
  // Init Slideout Menu
  $(".button-collapse").sideNav();
});

// Add class to header on scroll
var scrollPosition = function(){
  var scrollIsTop = $(window).scrollTop();
  if(scrollIsTop <= 200){
    $('.navbar-fixed').addClass('transparency');
  }
  else{
    $('.navbar-fixed').removeClass('transparency');
  }
}
$(window).on('scroll', scrollPosition);


// Viewport height containers
