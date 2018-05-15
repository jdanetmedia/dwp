<?php

class Settings {
  function getBasicPageInfo() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM BasicPageInfo");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

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
                ZipCode = :ZipCode";

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

  function getShippingMethods() {
    try {
      $conn = connectToDB();

      $handle = $conn->prepare("SELECT * FROM DeliveryMethod");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      // $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addShippingMethod($post) {
    $this->saveBasicPageInfo($post);

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
                  WHERE DeliveryMethodID = $id";

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
