<?php

class Settings {
  // Basic info
  function getBasicPageInfo() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM BasicPageInfo");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result[0];

      // $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function saveBasicPageInfo($post) {
    try {
      $conn = connectToDB();

      $query = "UPDATE BasicPageInfo
                SET CVR = :CVR,
                LogoURL = :LogoURL,
                ShopName = :ShopName,
                AboutUsText = :AboutUsText,
                Email = :Email,
                Phone = :Phone,
                Street = :Street,
                HouseNumber = :HouseNumber,
                ZipCode = :ZipCode,
                StripeToken = :StripeToken,
                HomeSeoTitle = :HomeSeoTitle,
                HomeMetaDescription = :HomeMetaDescription,
                ContactSeoTitle = :ContactSeoTitle,
                ContactMetaDescription = :ContactMetaDescription,
                ProductsSeoTitle = :ProductsSeoTitle,
                ProductsMetaDescription = :ProductsMetaDescription,
                BlogSeoTitle = :BlogSeoTitle,
                BlogMetaDescription = :BlogMetaDescription";

      $handle = $conn->prepare($query);
      $handle->bindParam(":CVR", $post["CVR"]);
      $handle->bindParam(":LogoURL", $post["LogoURL"]);
      $handle->bindParam(":ShopName", $post["ShopName"]);
      $handle->bindParam(":AboutUsText", $post["AboutUsText"]);
      $handle->bindParam(":Email", $post["Email"]);
      $handle->bindParam(":Phone", $post["Phone"]);
      $handle->bindParam(":Street", $post["Street"]);
      $handle->bindParam(":HouseNumber", $post["HouseNumber"]);
      $handle->bindParam(":ZipCode", $post["ZipCode"]);
      $handle->bindParam(":StripeToken", $post["StripeToken"]);
      $handle->bindParam(":HomeSeoTitle", $post["HomeSeoTitle"]);
      $handle->bindParam(":HomeMetaDescription", $post["HomeMetaDescription"]);
      $handle->bindParam(":ContactSeoTitle", $post["ContactSeoTitle"]);
      $handle->bindParam(":ContactMetaDescription", $post["ContactMetaDescription"]);
      $handle->bindParam(":ProductsSeoTitle", $post["ProductsSeoTitle"]);
      $handle->bindParam(":ProductsMetaDescription", $post["ProductsMetaDescription"]);
      $handle->bindParam(":BlogSeoTitle", $post["BlogSeoTitle"]);
      $handle->bindParam(":BlogMetaDescription", $post["BlogMetaDescription"]);
      $handle->execute();

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getCity($zip) {
    try {
      $conn = connectToDB();

      $query = "SELECT City FROM ZipCode WHERE ZipCode = :ZipCode";
      $handle = $conn->prepare($query);
      $handle->bindParam(":ZipCode", $zip);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result[0]["City"];

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  // Hours
  function getHours() {
    try {
        $conn = connectToDB();

        $query = "SELECT * FROM Hours";
        $handle = $conn->prepare($query);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        return $result;

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addHours($post) {
    try {
        $conn = connectToDB();

        $query = "INSERT INTO Hours (Day, Open, Close) VALUES (:Day, :Open, :Close)";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Day", $post["Day"]);
        $handle->bindParam(":Open", $post["Open"]);
        $handle->bindParam(":Close", $post["Close"]);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateHours($post, $id) {
    try {
        $conn = connectToDB();

        $query = "UPDATE Hours
                  SET Day = :Day,
                  Open = :Open,
                  Close = :Close
                  WHERE HoursID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Day", $post["Day"]);
        $handle->bindParam(":Open", $post["Open"]);
        $handle->bindParam(":Close", $post["Close"]);
        $handle->bindParam(":id", $id);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function deleteHours($id) {
    try {
        $conn = connectToDB();

        $query = "DELETE FROM Hours WHERE HoursID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":id", $id);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  // Shipping
  function getShippingMethods() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM DeliveryMethod");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addShippingMethod($post) {
    try {
        $conn = connectToDB();

        $query = "INSERT INTO DeliveryMethod (Method, MethodDescription, DeliveryPrice) VALUES (:Method, :MethodDescription, :DeliveryPrice)";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Method", $post["Method"]);
        $handle->bindParam(":MethodDescription", $post["MethodDescription"]);
        $handle->bindParam(":DeliveryPrice", $post["DeliveryPrice"]);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateShippingMethod($post, $id) {
    try {
        $conn = connectToDB();

        $query = "UPDATE DeliveryMethod
                  SET Method = :Method,
                  MethodDescription = :MethodDescription,
                  DeliveryPrice = :DeliveryPrice
                  WHERE DeliveryMethodID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Method", $post["Method"]);
        $handle->bindParam(":MethodDescription", $post["MethodDescription"]);
        $handle->bindParam(":DeliveryPrice", $post["DeliveryPrice"]);
        $handle->bindParam(":id", $id);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function deleteShippingMethod($id) {
    try {
        $conn = connectToDB();

        $query = "DELETE FROM DeliveryMethod WHERE DeliveryMethodID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":id", $id);
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
