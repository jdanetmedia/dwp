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
