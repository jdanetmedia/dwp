// Mobile navigation toggle
$(".button-collapse").sideNav();

//initialize select function
$(document).ready(function() {
  $('select').material_select();

  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();

  // Star rating
  $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
  });
  // Wiew productimage in full size
  $('.product-img').click(function() {
    $('.responsive-img').addClass('full');
    $('.overlay').addClass('show');
  });
  $('.overlay').click(function() {
    $('.responsive-img').removeClass('full');
    $('.overlay').removeClass('show');
  });
  $('.close-btn').click(function() {
    $('.responsive-img').removeClass('full');
    $('.overlay').removeClass('show');
  });
});
// Triggerns when ESC button is pressed
$(document).on('keyup',function(evt) {
    if (evt.keyCode == 27) {
      $('.responsive-img').removeClass('full');
      $('.overlay').removeClass('show');
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
