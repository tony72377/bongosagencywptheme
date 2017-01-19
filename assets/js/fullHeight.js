// Constantly check for window height
$(document).ready(function(){
  var fullHeight = $(window).height();
  $('.full-height').css("height", fullHeight);
  
  $(window).resize(function(){
    fullHeight = $(window).height();
    // Create full height containers
    $('.full-height').css("height", fullHeight);
  });
});
