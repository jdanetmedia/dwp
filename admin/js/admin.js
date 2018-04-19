$(document).ready(function() {
  // Product collapsible
  $('.collapsible').collapsible();
  // Editor
  $('.content').richText({
    //Uploads
    imageUpload: false,
    fileUpload: false,
    videoUpload: false
  });
  // Dropdown select
  $('select').material_select();

  $('.make-primary').click(function() {
    $('.primary-label').removeClass('is-primary').text('Secondary');
    $('.primary-input').val(false);
    $(this).siblings('.primary-label').addClass('is-primary').text('Primary');
    $(this).siblings('.primary-input').val(true);
  });
});
