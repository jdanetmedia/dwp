<?php
require_once("../includes/connection.php");

if (isset($_SESSION["OrderNumber"])) {
  echo "<h2>Your order was successfully placed!</h2>";
  unset($_SESSION["OrderNumber"]);
}

function getAllOrders($customerEmail) {
  try {
      $conn = connectToDB();

      $statement = "SELECT * FROM CustomerOrder WHERE CustomerEmail = :CustomerEmail ORDER BY OrderNumber DESC";

      $handle = $conn->prepare($statement);
      $handle->bindParam(':CustomerEmail', $customerEmail);
      $handle->execute();
      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;
  }
  catch(\PDOExeption $ex) {
      print($ex->getMessage());
  }
}

function getOrder($orderNumber){
  try {
      $conn = connectToDB();

      $statement = "SELECT * FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber WHERE OrderNumber = :OrderNumber";

      $handle = $conn->prepare($statement);
      $handle->bindParam(':OrderNumber', $orderNumber);
      $handle->execute();
      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $result;

      $statement2 = "SELECT * FROM DeliveryMethod
      INNER JOIN CustomerOrder ON DeliveryMethod.DeliveryMethodID = CustomerOrder.DeliveryMethodID
      INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID
      INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
      LEFT JOIN PromoCode ON CustomerOrder.PromoCode = PromoCode.PromoCode WHERE OrderNumber = :OrderNumber LIMIT 1";

      $handle = $conn->prepare($statement2);
      $handle->bindParam(':OrderNumber', $orderNumber);
      $handle->execute();
      $result2 = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $result2;

      $total = 0;
      //var_dump($result2);
      foreach($result as $item) {
        $total = $total + $item["FinalPrice"] * $item["Amount"];
      }
      //echo $total . "<br>";
      if(isset($result2[0]["DiscountAmount"])) {
        $totalBeforeDiscount = $total;
        $total = ($total / 100) * $result2[0]["DiscountAmount"];
      } else {
        $totalBeforeDiscount = NULL;
      };
      //echo "total " . $total . "<br>";
      $orderinfo = array(
        "Products"=>$result,
        "Total"=>$total,
        "BeforeDiscount"=>$totalBeforeDiscount,
        "OrderInfo"=>$result2[0],
    );
      //var_dump($orderinfo);
      return $orderinfo;
  }
  catch(\PDOExeption $ex) {
      print($ex->getMessage());
  }
}
?>
