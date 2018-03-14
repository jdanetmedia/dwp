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
});
