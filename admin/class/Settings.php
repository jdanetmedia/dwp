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
                HouseNumber = :HouseNumber";

      $handle = $conn->prepare($query);
      $handle->bindParam(":CVR", $post["CVR"]);
      $handle->bindParam(":LogoURL", $post["LogoURL"]);
      $handle->bindParam(":ShopName", $post["ShopName"]);
      $handle->bindParam(":AboutUsText", $post["AboutUsText"]);
      $handle->bindParam(":Email", $post["Email"]);
      $handle->bindParam(":Phone", $post["Phone"]);
      $handle->bindParam(":Street", $post["Street"]);
      $handle->bindParam(":HouseNumber", $post["HouseNumber"]);
      $handle->execute();

      $conn = null;
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
