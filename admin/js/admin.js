function getCity(zip) {
  if (zip == "") {
    $('.cityTxt').val("");
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
          $('.cityTxt').val(this.responseText);
      }
  };
  xmlhttp.open("GET","../model/findcity.php?q="+zip,true);
  xmlhttp.send();
  }
}

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: true, // Close upon selecting a date,
    container: undefined, // ex. 'body' will append picker to body
    format: 'yyyy-mm-dd',
  });

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
    $('.content1').richText({
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

  // Edit shippingmethod Modal
  $('.edit').click(function() {
    var itemID = $(this).attr('id');
    var method = $(this).siblings('.method').text();
    var desc = $(this).siblings('.description').text();
    var price = $(this).siblings('.priceRow').text();

    $('.shippingID').val(itemID);
    $('.Method').val(method);
    $('.MethodDescription').val(desc);
    $('.DeliveryPrice').val(price);
  });
});
