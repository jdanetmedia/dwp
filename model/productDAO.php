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
  global $connection;

  $rating = $_POST["rating"];
  $reviewTitle = $_POST["reviewTitle"];
  $reviewText = $_POST["reviewText"];
  $itemNumber = $item;

  $query = "INSERT INTO Review VALUES (NULL, NULL, '{$rating}', '{$reviewTitle}', NULL, '{$reviewText}', '{$itemNumber}')";
  mysqli_query($connection, $query);
}

function getRelatedProducts($productCat) {
  global $connection;

  $query = "SELECT * FROM Product WHERE ProductCategoryID = $productCat AND ProductStatus = 1 LIMIT 5";
  $result = mysqli_query($connection, $query);
  return $result;
}
