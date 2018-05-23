<?php
class Order {

  function mailCheck($connection, $ordernumber)
  {
      $query = "SELECT CustomerEmail, OrderNumber, OrderDate FROM CustomerOrder WHERE OrderNumber = $ordernumber";
      $result = mysqli_query($connection, $query);

      if (mysqli_num_rows($result) == 1) {
        // username/password authenticated
        // and only 1 match
        $info = mysqli_fetch_array($result);
        $email_to = $info['CustomerEmail'];

      }

      $subject = "Email regarding order: " . $ordernumber . " from Rubberduck shop";

      function error($error)
      {
          echo "Error processing your form input<br><br>";
          echo "<b>The errors are:</b><br> ";
          echo $error . "<br>";
          die();
      }

      //Validation of null fields
      if (!isset($_POST["ordermessage"])) {
          error("No input to validate!");
      }

      $email = "r@rasmusandreas.dk";
      $message = $_POST["ordermessage"];
      $error_message = "";

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error_message .= "The email is not OK!<br>";
      }

      if (strlen($message) <= 0) {
          $error_message .= "Your message is too short!<br>";
      }

      if (strlen($error_message) > 0) {
          error($error_message);
      }

      $email_message = "Message:\n\n";

      function clean_string($string)
      {
          $bad = array("content-type", "bcc:", "to:", "cc:", "href");
          return str_replace($bad, "", $string);
      }

      $email_message .= clean_string($message) . "\n";

      $headers = "FROM: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();

      date_default_timezone_set("Europe/Copenhagen");
      $time = date("Y-m-d H:i:s");

      mail($email_to, $subject, $email_message, $headers);
      $insertquery = "INSERT INTO OrderMessage VALUES (NULL, '{$message}', '{$time}', '{$ordernumber}');";
      $newmessage = mysqli_query($connection, $insertquery);

      echo "Your message was '$message' and was sent from $email";
  }

  function getLatestOrders() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID ORDER BY OrderNumber DESC LIMIT 3");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getAllOrders() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID ORDER BY OrderNumber DESC");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getSum($ordernumber) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT SUM(OrderDetails.FinalPrice * OrderDetails.Amount) + DeliveryMethod.DeliveryPrice AS totalprice
      FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber
      INNER JOIN CustomerOrder ON OrderDetails.OrderNumber = CustomerOrder.OrderNumber
      INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
      WHERE OrderDetails.OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getOrder($ordernumber) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID
        WHERE CustomerOrder.OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getMessage($ordernumber) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM OrderMessage
        WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getProducts($ordernumber) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function CheckStock() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM Product WHERE StockStatus < 50 ORDER BY StockStatus ASC");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateStatus($ordernumber, $newstatus) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("UPDATE CustomerOrder SET OrderStatusID = '{$newstatus}' WHERE OrderNumber = '{$ordernumber}'");
      $handle->execute();
      // TODO: if changed to sent send a mail
      $this->sendUpdateMail($ordernumber, $newstatus);
      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getStatus(){
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM OrderStatus");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

function getPromoCodeDiscount($promocode) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT DiscountAmount FROM PromoCode WHERE PromoCode = :promocode");
      $handle->bindParam(":promocode", $promocode);
      $handle->execute();
      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function sendUpdateMail($ordernumber, $newstatus) {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT CustomerEmail FROM CustomerOrder WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $email = $result[0]["CustomerEmail"];

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM OrderStatus WHERE OrderStatusID = $newstatus");
      $handle->execute();

      $resultone = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $status = $resultone[0]["Status"];

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }

    $subject = "Order status changed to: $status";
    $domain = $_SERVER['HTTP_HOST'];
    $statusmessage = 'Your order #' . $ordernumber . ' was successfully ' . $status . "\n" . 'You can see your order details here:
    <' . $domain . '/view/order.php?order=' . $ordernumber . '>';
    $error_message = "";

    $email_message = "Order update:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Message: " . $statusmessage . "\n";

    $headers = "FROM: " . "noreply@rasmusandreas.dk" . "\r\n" . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();

    mail($email, $subject, $email_message, $headers);
  }

  function getOrderDetails($orderNumber){
    try {
        $conn = DB::connect();

        $statement = "SELECT * FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber WHERE OrderNumber = :OrderNumber";

        $handle = $conn->prepare($statement);
        $handle->bindParam(':OrderNumber', $orderNumber);
        $handle->execute();
        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        $result;

        $statement2 = "SELECT * FROM DeliveryMethod
        INNER JOIN CustomerOrder ON DeliveryMethod.DeliveryMethodID = CustomerOrder.DeliveryMethodID
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
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

}
?>
