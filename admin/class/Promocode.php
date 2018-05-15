<?php
class Promocode {
  function getAllPromocodes() {
      try {
          $conn = connectToDB();

          $handle = $conn->prepare("SELECT *  FROM PromoCode");
          $handle->execute();

          $result = $handle->fetchAll( \PDO::FETCH_OBJ );
          $conn = null;
          return $result;
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }

  function getPromocode($promocode) {
      try {
          $conn = connectToDB();
          $statement = "SELECT * FROM PromoCode WHERE PromoCode = :PromoCode";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $promocode);
          $handle->execute();

          $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
          return $result;
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }
}
?>
