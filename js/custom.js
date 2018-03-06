// Mobile navigation toggle
$(".button-collapse").sideNav();

//initialize select function
$(document).ready(function() {
  $('.carousel').carousel({
              dist:0,
              shift:0,
              padding:20,

        });

  $('select').material_select();

  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();

  // Star rating
  $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
  });

  // slider
  $('.carousel.carousel-slider').carousel({fullWidth: true});

  // Product collapsible
  $('.collapsible').collapsible();

  // Input counter
  $('input#input_text, textarea#textarea1').characterCounter();

  // Image zoom (not product frontend view)
  $('.materialboxed').materialbox();

  // Wiew productimage in full size
  $('.product-img').click(function() {
    $('.productimage-overlay').css('display', 'none');
    $('.responsive-img').addClass('full');
    $('.overlay').addClass('show');
    $('.productimage-cnt').addClass('static');
  });
  $('.overlay').click(function() {
    $('.productimage-overlay').css('display', 'block');
    $('.responsive-img').removeClass('full');
    $('.overlay').removeClass('show');
    $('.productimage-cnt').removeClass('static');
  });
  $('.close-btn').click(function() {
    $('.productimage-overlay').css('display', 'block');
    $('.responsive-img').removeClass('full');
    $('.overlay').removeClass('show');
    $('.productimage-cnt').removeClass('static');
  });
});
// Triggerns when ESC button is pressed
$(document).on('keyup',function(evt) {
    if (evt.keyCode == 27) {
      $('.productimage-overlay').css('display', 'block');
      $('.responsive-img').removeClass('full');
      $('.overlay').removeClass('show');
      $('.productimage-cnt').removeClass('static');
    }
});

// initialize slider
var slider = document.getElementById('price-slider');
noUiSlider.create(slider, {
 start: [0, 100],
 connect: true,
 step: 1,
 orientation: 'horizontal', // 'horizontal' or 'vertical'
 range: {
   'min': 0,
   'max': 100
 },
 format: wNumb({
   decimals: 0, // default is 2
 })
});
