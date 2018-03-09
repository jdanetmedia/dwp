<?php
// DB Connection
require_once("connection.php");

// Function to get the current item on single productpage
function getCurrentProduct($itemNumber) {
  $cnx = connectToDB();

  try {
    $handle = $cnx->prepare( "SELECT * FROM Product WHERE ItemNumber = $itemNumber" );
    $handle->execute();

    $result = $handle->fetch( \PDO::FETCH_OBJ );

    return $result;
  }
  catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

// Get reviews for current product
function getReviews($itemNumber) {
  global $connection;

  $query = "SELECT * FROM Review WHERE ItemNumber = $itemNumber";

  $result = mysqli_query($connection, $query);
  return $result;
}
