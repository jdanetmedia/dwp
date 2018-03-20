<?php
// DB Connection
require_once("connection.php");

// Function to get the current item on single productpage
function getCurrentProduct($itemNumber) {
  global $connection;

  $query = "SELECT Product.*, ImgGallery.URL, ImgGallery.IsPrimary FROM Product INNER JOIN ProductImg ON ProductImg.ItemNumber = Product.ItemNumber INNER JOIN ImgGallery ON ImgGallery.ImgID = ProductImg.ImgID WHERE Product.ItemNumber = $itemNumber";
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

function getRelatedProducts($productCat) {
  global $connection;

  $query = "SELECT * FROM Product WHERE ProductCategoryID = $productCat LIMIT 5";
  $result = mysqli_query($connection, $query);
  return $result;
}
