<?php
// DB Connection
require_once("connection.php");

// Function to get the current item on single productpage
function getCurrentProduct($itemNumber) {
  global $connection;

  $query = "SELECT * FROM Product WHERE ItemNumber = $itemNumber";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  return $row;
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
