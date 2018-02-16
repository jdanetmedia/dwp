// Mobile navigation toggle
$(".button-collapse").sideNav();

//initialize select function
$(document).ready(function() {
    $('select').material_select();
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
