<?php
require_once("includes/connection.php");

function getAllOrders($customerEmail) {
  global $connection;

  $query = "SELECT * FROM CustomerOrder WHERE CustomerEmail = '{$customerEmail}' ORDER BY OrderNumber DESC";
  $result = mysqli_query($connection, $query);
  return $result;
}
?>
