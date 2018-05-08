$(document).ready(function() {
    $('.modal').modal();
  // Product collapsible
  $('.collapsible').collapsible();
  // Editor
  $('.content').richText({
    //Uploads
    imageUpload: false,
    fileUpload: false,
    videoUpload: false
  });
  // Dropdown selectal
  $('select').material_select();

  $('.make-primary').click(function() {
    $('.primary-label').removeClass('is-primary').text('Secondary');
    $('.primary-input').val(false);
    $(this).siblings('.primary-label').addClass('is-primary').text('Primary');
    $('.change-img').val($(this).attr('id'));
    $('.save-message').css('display', 'block');
  });

  // Gallery image selection
  $('.img-item').click(function() {
    $('.sendId').val($(this).attr('id'));
    $('.img-item').removeClass('selected');
    $(this).addClass('selected');
  });

  // Remove image from product
  $('.remove-img').click(function() {
    $('.delete-image').val($(this).attr('id'));
    $('.material-placeholder').removeClass('opague');
    $(this).siblings('.material-placeholder').addClass('opague');
    $('.save-delete').css('display', 'none');
    $(this).siblings('.save-delete').css('display', 'block');
  });
});
