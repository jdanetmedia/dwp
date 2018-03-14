<?php
require_once("../includes/connection.php");

function getAllProducts() {
  global $connection;

  $query = "SELECT * FROM Product";
  $result = mysqli_query($connection, $query);
  return $result;
}

function getProductDetails($itemNumber) {
  global $connection;

  $query = "SELECT * FROM Product WHERE ItemNumber = $itemNumber";
  $result = mysqli_query($connection, $query);
  return mysqli_fetch_assoc($result);
}
