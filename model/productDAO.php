<?php
// DB Connection
require_once("../includes/connection.php");

if(isset($_POST["submitreview"])) {
  addReview($_GET["item"]);
}

// Function to get the current item on single productpage
function getCurrentProduct($itemNumber) {
  global $connection;

  $query = "SELECT Product.*, ImgGallery.URL, ProductImg.IsPrimary FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber";
  // $query = "SELECT * FROM Product WHERE ItemNumber = $itemNumber";
  $result = mysqli_query($connection, $query);
  return $result;
}

// Get reviews for current product
function getReviews($itemNumber) {
  global $connection;

  $query = "SELECT * FROM Review WHERE ItemNumber = $itemNumber";
  $result = mysqli_query($connection, $query);
  return $result;
}

// Add review for current product
function addReview($item) {
  $errMsg = "";
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    //your site secret key
    $secret = '6LfRflkUAAAAANg0eaCe2bfDQ4w_khZq5xPDKMy0';
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success){
      global $connection;

      $rating = $_POST["rating"];
      $reviewTitle = $_POST["reviewTitle"];
      $reviewText = $_POST["reviewText"];
      $itemNumber = $item;

      $query = "INSERT INTO Review VALUES (NULL, NULL, '{$rating}', '{$reviewTitle}', NULL, '{$reviewText}', '{$itemNumber}')";
      mysqli_query($connection, $query);

      $succMsg = 'Your review have been submitted successfully.';
      echo $succMsg;
    } else {
      $errMsg .= 'Robot verification failed, please try again.';
    }
  } else {
    $errMsg .= 'Please click on the reCAPTCHA box.';
  }
}

function getRelatedProducts($productCat) {
  global $connection;

  $query = "SELECT ProductImg.IsPrimary, ImgGallery.*, Product.* FROM `Product` INNER JOIN `ProductImg` ON Product.ItemNumber = ProductImg.ItemNumber INNER JOIN `ImgGallery` ON ProductImg.ImgID = ImgGallery.ImgID WHERE IsPrimary = 1 AND Product.ProductStatus = 1 AND Product.ProductCategoryID = $productCat LIMIT 5";
  $result = mysqli_query($connection, $query);
  return $result;
}
