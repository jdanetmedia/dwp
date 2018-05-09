<?php

class Settings {
  function __construct() {
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

  function saveBasicPageInfo() {
    try {
      $conn = connectToDB();

      $query = "INSERT INTO BasicPageInfo (CVR, LogoURL, ShopName, MinimumDelivery, AboutUsText, Email, Phone, Street, HouseNumber)
                VALUES(:CVR, :LogoURL, :ShopName, :MinimumDelivery, :AboutUsText, :Email, :Phone, :Street, :HouseNumber)";

      $handle = $conn->prepare("INSERT INTO BasicPageInfo (CVR, LogoURL, ShopName, MinimumDelivery, AboutUsText, Email, Phone, Street, HouseNumber)
                                VALUES(:CVR, :LogoURL, :ShopName, :MinimumDelivery, :AboutUsText, :Email, :Phone, :Street, :HouseNumber)");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      // $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
