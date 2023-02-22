$(document).on('click', 'a[href^="#test+i"]', function(event) {
   event.preventDefault();
   $('html, body').animate({
       scrollTop: $($.attr(this, 'href')).offset().top
   }, 1000);
});