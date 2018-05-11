<?php
require_once("../includes/connection.php");

if (isset($_SESSION["OrderNumber"])) {
  echo "<h2>Your order was succssfully placed!</h2>";
  unset($_SESSION["OrderNumber"]);
}

function getAllOrders($customerEmail) {
  global $connection;

  $query = "SELECT * FROM CustomerOrder WHERE CustomerEmail = '{$customerEmail}' ORDER BY OrderNumber DESC";
  $result = mysqli_query($connection, $query);
  return $result;
}

function getOrder($orderNumber) {
  global $connection;

  $query = "SELECT * FROM CustomerOrder INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode WHERE OrderNumber = $orderNumber";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function getOrderProducts($orderNumber) {
  global $connection;

  $query = "SELECT * FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber WHERE OrderDetails.OrderNumber = $orderNumber";
  $result = mysqli_query($connection, $query);
  return $result;
}
?>
