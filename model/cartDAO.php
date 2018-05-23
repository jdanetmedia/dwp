<?php
if (isset($_POST["submitcart"])) {
    addtocart($_GET["item"], $_POST["amount"]);
}

//unset($_SESSION["cart"]);

function addtocart($item, $amount) {
  $amount = (int)$amount;
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array($item => $amount);
  } else {
    if (!isset($_SESSION["cart"][$item])) {
      array_push_assoc($_SESSION["cart"], $item, $amount);
    } else {
      addmoreitems($_SESSION["cart"], $item, $amount);
    }

  }
}

function array_push_assoc(&$array, $key, $value){
$array[$key] = $value;
return $array;
}

function addmoreitems(&$array, $key, $value){
$oldvalue = $array[$key];
$array[$key] = $oldvalue + $value;
return $array;
}

// DB Connection

// Function to get the current item on single productpage
function getCartProduct($itemNumber) {
  try {
      $conn = DB::connect();

      $itemNumber = Security::secureString($itemNumber);

      $query = "SELECT * FROM Product INNER JOIN ProductImg ON Product.ItemNumber = ProductImg.ItemNumber INNER JOIN ImgGallery ON ProductImg.ImgID = ImgGallery.ImgID WHERE Product.ItemNumber = :itemNumber AND ProductImg.IsPrimary = true";

      $handle = $conn->prepare($query);
      $handle->bindParam(':itemNumber', $itemNumber);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

// remove from cart
if(isset($_GET["remove"])) {
  unset($_SESSION["cart"][$_GET["remove"]]);
}

if(isset($_POST["updatecart"])) {
  foreach($_SESSION["cart"] as $key => $value) {
    array_push_assoc($_SESSION["cart"], $key, $_POST["$key"]);
  }
}

// TODO: make sure the important fields are filled out
if(isset($_POST["submitshipping"])) {
  if (isset($_POST["saveaddress"]) && $_POST["saveaddress"] == "true") {
    updateAddress($_SESSION["CustomerEmail"], $_POST["street"], $_POST["house"], $_POST["zipcode"], $_POST["city"]);
  }
  $time = date("Y-m-d H:i:s");

  if (isset($_SESSION["promocode"])) {
    $PromoCode = $_SESSION["promocode"];
  } else {
    $PromoCode = NULL;
  }

  saveOrderToDB($_POST["ordermessage"], "Not completed", $time, $_POST["street"], $_POST["house"], $_POST["zipcode"], $_SESSION["CustomerEmail"], $_POST["shippingoption"], 1, $PromoCode);

  $_SESSION["street"] = $_POST["street"];
  $_SESSION["house"] = $_POST["house"];
  $_SESSION["zipcode"] = $_POST["zipcode"];
  $_SESSION["city"] = $_POST["city"];
  if (isset($_POST["saveaddress"])) {
      $_SESSION["saveaddress"] = $_POST["saveaddress"];
  }
  $_SESSION["shippingoption"] = $_POST["shippingoption"];
  if(isset($_POST["ordermessage"])) {
    $_SESSION["ordermessage"] = $_POST["ordermessage"];
  }
}

function updateAddress($CustomerEmail, $Street, $HouseNumber, $ZipCode, $City) {
  try {
      $conn = DB::connect();

      $CustomerEmail = Security::secureString($CustomerEmail);
      $Street = Security::secureString($Street);
      $HouseNumber = Security::secureString($HouseNumber);
      $ZipCode = Security::secureString($ZipCode);
      $City = Security::secureString($City);

      $query = "UPDATE Customer SET Street = :Street, HouseNumber = :HouseNumber, ZipCode = :ZipCode WHERE CustomerEmail = :CustomerEmail";
      $handle = $conn->prepare($query);
      $handle->bindParam(':Street', $Street);
      $handle->bindParam(':CustomerEmail', $CustomerEmail);
      $handle->bindParam(':HouseNumber', $HouseNumber);
      $handle->bindParam(':ZipCode', $ZipCode);
      $handle->execute();

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getCityName($ZipCode) {
  try {
      $conn = DB::connect();

      $ZipCode = Security::secureString($ZipCode);

      $query = "SELECT * FROM ZipCode WHERE ZipCode = :zipcode";
      $handle = $conn->prepare($query);
      $handle->bindParam(':zipcode', $ZipCode);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function getDeliveryInfo($DeliveryMethodID) {
  try {
      $conn = DB::connect();

      $itemNumber = Security::secureString($DeliveryMethodID);

      $query = "SELECT * FROM DeliveryMethod WHERE DeliveryMethodID = :DeliveryMethod";
      $handle = $conn->prepare($query);
      $handle->bindParam(':DeliveryMethod', $DeliveryMethodID);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}

function saveOrderToDB($Ordermessage, $StripeChargeID, $Time, $Street, $HouseNumber, $ZipCode, $CustomerEmail, $Shippingoption, $OrderStatus, $PromoCode) {
  try {
    //create a new PDO connection object
    $conn = DB::connect();

    $conn->beginTransaction();

    $Ordermessage = Security::secureString($Ordermessage);
    $StripeChargeID = Security::secureString($StripeChargeID);
    $Time = Security::secureString($Time);
    $Street = Security::secureString($Street);
    $HouseNumber = Security::secureString($HouseNumber);
    $ZipCode = Security::secureString($ZipCode);
    $CustomerEmail = Security::secureString($CustomerEmail);
    $Shippingoption = Security::secureString($Shippingoption);
    $OrderStatus = Security::secureString($OrderStatus);
    $PromoCode = Security::secureString($PromoCode);

    $statement = "INSERT INTO CustomerOrder (OrderNumber, Comment, StripeChargeID, OrderDate, ShippingStreet, ShippingHouseNumber, ZipCode, CustomerEmail, DeliveryMethodID, OrderStatusID, PromoCode)
                  VALUES (NULL, :Ordermessage, :StripeChargeID, :OrderTime, :Street, :HouseNumber, :ZipCode, :CustomerEmail, :Shippingoption, :OrderStatus, :PromoCode)";

    $handle = $conn->prepare($statement);
    $handle->bindParam(':Ordermessage', $Ordermessage);
    $handle->bindParam(':StripeChargeID', $StripeChargeID);
    $handle->bindParam(':OrderTime', $Time);
    $handle->bindParam(':Street', $Street);
    $handle->bindParam(':HouseNumber', $HouseNumber);
    $handle->bindParam(':ZipCode', $ZipCode);
    $handle->bindParam(':CustomerEmail', $CustomerEmail);
    $handle->bindParam(':Shippingoption', $Shippingoption);
    $handle->bindParam(':OrderStatus', $OrderStatus);
    $handle->bindParam(':PromoCode', $PromoCode);
    $handle->execute();

    //throw new Exception("Simulate DBMS failure");

    $_SESSION["cart"];
    $OrderNumber = $conn->lastInsertId();
    $_SESSION["OrderNumber"] = $OrderNumber;
    //echo $OrderNumber;

    foreach($_SESSION["cart"] as $key => $value) {
      $key = Security::secureString($key);
      $statement2 = "SELECT Price, OfferPrice FROM Product WHERE ItemNumber = :key";
      $handle = $conn->prepare($statement2);
      $handle->bindParam(':key', $key);
      $handle->execute();
      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      if(isset($result[0]["OfferPrice"])) {
        $price = $result[0]["OfferPrice"];
      } else {
        $price = $result[0]["Price"];
      }

      $key = Security::secureString($key);
      $OrderNumber = Security::secureString($OrderNumber);
      $value = Security::secureString($value);
      $price = Security::secureString($price);

      $statement1 = "INSERT INTO OrderDetails VALUES (:OrderNumber, :key, :value, :price)";
      $handle = $conn->prepare($statement1);
      $handle->bindParam(':OrderNumber', $OrderNumber);
      $handle->bindParam(':key', $key);
      $handle->bindParam(':value', $value);
      $handle->bindParam(':price', $price);
      $handle->execute();

      $statement2 = "UPDATE Product SET StockStatus = StockStatus - :value WHERE ItemNumber = :key";
      $handle = $conn->prepare($statement2);
      $handle->bindParam(':key', $key);
      $handle->bindParam(':value', $value);
      $handle->execute();
    }

    if (isset($_SESSION["promocode"])) {
      $_SESSION["promocode"] = Security::secureString($_SESSION["promocode"]);
      $statement3 = "UPDATE PromoCode SET NumberOfUses = NumberOfUses - 1 WHERE PromoCode = :PromoCode";
      $handle = $conn->prepare($statement3);
      $handle->bindParam(':PromoCode', $_SESSION["promocode"]);
      $handle->execute();
    }

    $conn->commit();
  }
  catch (Exception $e)
  {
    $conn->rollBack();
    print "Failure! Aborting!";
    print($e);
  }
}

if (isset($_POST["submitpromocode"])) {
    $promocode = checkForPromoCode($_POST["promocode"]);
    $pTime = date("Y-m-d H:i:s");
    if (isset($promocode[0])) {
      if ($promocode[0]["EndDate"] >= $pTime || $promocode[0]["EndDate"] == NULL || $promocode[0]["EndDate"] == "0000-00-00") {
        if ($promocode[0]["StartDate"] <= $pTime || $promocode[0]["StartDate"] == NULL || $promocode[0]["StartDate"] == "0000-00-00") {
          if ($promocode[0]["NumberOfUses"] > 0) {
          $_SESSION["promocode"] = $promocode[0]["PromoCode"];
          $_SESSION["DiscountAmount"] = $promocode[0]["DiscountAmount"];
        } else if ($promocode[0]["NumberOfUses"] = 0) {
            $_SESSION["promocode"] = NULL;
            if (isset($_SESSION["DiscountAmount"])) {
              unset($_SESSION["DiscountAmount"]);
            }
          }
        } else {
          $_SESSION["promocode"] = NULL;
          if (isset($_SESSION["DiscountAmount"])) {
            unset($_SESSION["DiscountAmount"]);
          }
        }
      } else {
        $_SESSION["promocode"] = NULL;
        if (isset($_SESSION["DiscountAmount"])) {
          unset($_SESSION["DiscountAmount"]);
        }
      }
    }
}

function checkForPromoCode($PromoCode) {
  try {
      $conn = DB::connect();

      $PromoCode = Security::secureString($PromoCode);

      $statement = "SELECT * FROM PromoCode WHERE PromoCode = :PromoCode";

      $handle = $conn->prepare($statement);
      $handle->bindParam(':PromoCode', $PromoCode);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;
  }
  catch(\PDOException $ex) {
      print($ex->getMessage());
  }
}

function getDeliveryMethod() {
  try {
      $conn = DB::connect();

      $query = "SELECT * FROM `DeliveryMethod`";

      $handle = $conn->prepare($query);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      $conn = DB::close();
      return $result;

  }
  catch(\PDOException $ex) {
      return print($ex->getMessage());
  }
}
?>
