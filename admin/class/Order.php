<?php
class Order {
  function getAllOrders() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode ORDER BY OrderNumber DESC");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getSum($ordernumber) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT SUM(Product.Price * OrderDetails.Amount) + DeliveryMethod.DeliveryPrice AS totalprice
      FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber
      INNER JOIN CustomerOrder ON OrderDetails.OrderNumber = CustomerOrder.OrderNumber
      INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
      WHERE OrderDetails.OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getOrder($ordernumber) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
?>
