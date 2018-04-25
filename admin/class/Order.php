<?php
class Order {

  function __construct($connection, $ordernumber)
  {
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

        $email_message = "Form details below:\n\n";

        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }

        $email_message .= "Message: " . clean_string($message) . "\n";

        $headers = "FROM: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();

        mail($email_to, $subject, $email_message, $headers);
        $insertquery = "INSERT INTO OrderMessage VALUES (NULL, '{$message}', '2017-11-11 15:23:44', '{$ordernumber}');";
        $newmessage = mysqli_query($connection, $insertquery);

        echo "Your message was '$message' and was sent from $email";
      }

    if (isset($_POST["ordermessage"])) {
        mailCheck($connection, $ordernumber);
    }
  }

  function getLatestOrders() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID ORDER BY OrderNumber DESC LIMIT 3");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getAllOrders() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID ORDER BY OrderNumber DESC");
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

      $handle = $conn->prepare("SELECT * FROM CustomerOrder
        INNER JOIN Customer ON CustomerOrder.CustomerEmail = Customer.CustomerEmail
        INNER JOIN ZipCode ON CustomerOrder.ZipCode = ZipCode.ZipCode
        INNER JOIN DeliveryMethod ON CustomerOrder.DeliveryMethodID = DeliveryMethod.DeliveryMethodID
        INNER JOIN OrderStatus ON CustomerOrder.OrderStatusID = OrderStatus.OrderStatusID
        INNER JOIN OrderMessage ON CustomerOrder.OrderNumber = OrderMessage.OrderNumber
        WHERE CustomerOrder.OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getMessage($ordernumber) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM OrderMessage
        WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getProducts($ordernumber) {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM OrderDetails INNER JOIN Product ON OrderDetails.ItemNumber = Product.ItemNumber WHERE OrderNumber = $ordernumber");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_OBJ );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function CheckStock() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM Product WHERE StockStatus < 50 ORDER BY StockStatus ASC");
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
