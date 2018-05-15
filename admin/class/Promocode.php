<?php
class Promocode {
  function __construct($promocode) {
        if(isset($_POST["submitupdatepromo"])) {
          $this->updatePromocode($promocode);
        }

        if(isset($_POST["submitdeletepromo"])) {
          $this->deletePromocode($promocode);
        }

        if(isset($_POST["submitcreatepromo"])) {
          $this->createPromocode();
        }
    }

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

  function updatePromocode($oldpromocode) {
      try {
          $conn = connectToDB();
          $statement = "UPDATE PromoCode SET
                        PromoCode = :PromoCode,
                        DiscountAmount = :DiscountAmount,
                        StartDate = :StartDate,
                        EndDate = :EndDate,
                        NumberOfUses = :NumberOfUses,
                        UserEmail = :UserEmail
                        WHERE PromoCode = :OldPromoCode";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $_POST["promocode"]);
          $handle->bindParam(":DiscountAmount", $_POST["discount"]);
          $handle->bindParam(":StartDate", $_POST["startdate"]);
          $handle->bindParam(":EndDate", $_POST["enddate"]);
          $handle->bindParam(":NumberOfUses", $_POST["uses"]);
          $handle->bindParam(":UserEmail", $_SESSION["UserEmail"]);
          $handle->bindParam(":OldPromoCode", $oldpromocode);
          $handle->execute();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }

  function deletePromocode($promocode) {
      try {
          $conn = connectToDB();

          $statement = "DELETE FROM PromoCode WHERE PromoCode = :promocode";

          $handle = $conn->prepare($statement);

          $handle->bindParam(':promocode', $promocode);

          $handle->execute();
          $conn = null; //CLOSE THE CONNECTION BRUH ?!
      }
      catch(\PDOExeption $ex) {
          print($ex->getMessage());
      }
  }

  function createPromocode() {
      try {
          $conn = connectToDB();
          $statement = "INSERT INTO PromoCode VALUES
                        (:PromoCode,
                        :DiscountAmount,
                        :StartDate,
                        :EndDate,
                        :NumberOfUses,
                        :UserEmail)";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $_POST["promocode"]);
          $handle->bindParam(":DiscountAmount", $_POST["discount"]);
          $handle->bindParam(":StartDate", $_POST["startdate"]);
          $handle->bindParam(":EndDate", $_POST["enddate"]);
          $handle->bindParam(":NumberOfUses", $_POST["uses"]);
          $handle->bindParam(":UserEmail", $_SESSION["UserEmail"]);
          $handle->execute();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }
}
?>
