function showUser(str) {
  if (str == "") {
    $('.txtHint').val("");
    return;
  } else {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $('.txtHint').val(this.responseText);
        }
    };
    xmlhttp.open("GET","../model/findcity.php?q="+str,true);
    xmlhttp.send();
  }
}

// Mobile navigation toggle
$(".button-collapse").sideNav();

$(document).ready(function() {

  $(".install1").animate({width: '50%'}, "fast");
  $(".install2").animate({width: '100%'}, "fast");

  $('.carousel').carousel({
              dist:0,
              shift:0,
              padding:20,

        });

  autoplay();
  function autoplay() {
      $('.carousel-slider').carousel('next');
      setTimeout(autoplay, 3000);
  }

  //initialize select function
  $('select').material_select();

  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();

  // slider
  $('.carousel.carousel-slider').carousel({fullWidth: true});

  // Input counter
  $('input#input_text, textarea#textarea1').characterCounter();

  // Image zoom
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

  // Star rating input
  $('.star-1').click(function() {
    $('.star-icon').text('star_border').css('color', 'rgba(0,0,0,0.87)');
    $(this).children('.star-icon').text('star').css('color', '#f1c40f');
    $('.rating-input').val($(this).attr('id'));
  });
  $('.star-2').click(function() {
    $('.star-icon').text('star_border').css('color', 'rgba(0,0,0,0.87)');
    $('.star-1').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-2').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.rating-input').val($(this).attr('id'));
  });
  $('.star-3').click(function() {
    $('.star-icon').text('star_border').css('color', 'rgba(0,0,0,0.87)');
    $('.star-1').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-2').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-3').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.rating-input').val($(this).attr('id'));
  });
  $('.star-4').click(function() {
    $('.star-icon').text('star_border').css('color', 'rgba(0,0,0,0.87)');
    $('.star-1').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-2').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-3').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-4').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.rating-input').val($(this).attr('id'));
  });
  $('.star-5').click(function() {
    $('.star-icon').text('star_border').css('color', 'rgba(0,0,0,0.87)');
    $('.star-1').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-2').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-3').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-4').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.star-5').children('.star-icon').text('star').css('color', '#f1c40f');
    $('.rating-input').val($(this).attr('id'));
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
