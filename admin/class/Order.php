<?php
class Order extends DBConnect {
  function getAllOrders() {
    global $connection;

    $query = "SELECT * FROM CustomerOrder ORDER BY OrderNumber DESC";
    $result = mysqli_query($this->link, $query);
    return $result;
  }
}
?>
