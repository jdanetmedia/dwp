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

          $handle = $conn->prepare("SELECT * FROM PromoCode");
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
          // Secure input
          $secPromo = Security::secureString($promocode);

          $conn = DB::connect();
          $statement = "SELECT * FROM PromoCode WHERE PromoCode = :PromoCode";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $secPromo);
          $handle->execute();

          $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
          return $result;

          $conn = DB::close();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }

  function updatePromocode($oldpromocode) {
      try {
          $conn = DB::connect();

          // Secure input
          $promocode = Security::secureString($_POST["promocode"]);
          $discount = Security::secureString($_POST["discount"]);
          $startdate = Security::secureString($_POST["startdate"]);
          $enddate = Security::secureString($_POST["enddate"]);
          $numberOfUses = Security::secureString($_POST["uses"]);
          $userEmail = Security::secureString($_SESSION["UserEmail"]);
          $oldCode = Security::secureString($oldpromocode);

          $statement = "UPDATE PromoCode SET
                        PromoCode = :PromoCode,
                        DiscountAmount = :DiscountAmount,
                        StartDate = :StartDate,
                        EndDate = :EndDate,
                        NumberOfUses = :NumberOfUses,
                        UserEmail = :UserEmail
                        WHERE PromoCode = :OldPromoCode";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $promocode);
          $handle->bindParam(":DiscountAmount", $discount);
          $handle->bindParam(":StartDate", $startdate);
          $handle->bindParam(":EndDate", $enddate);
          $handle->bindParam(":NumberOfUses", $numberOfUses);
          $handle->bindParam(":UserEmail", $userEmail);
          $handle->bindParam(":OldPromoCode", $oldCode);
          $handle->execute();

          $conn = DB::close();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }

  function deletePromocode($promocode) {
      try {
          $conn = DB::connect();

          // Secure input
          $secCode = Security::secureString($promocode);

          $statement = "DELETE FROM PromoCode WHERE PromoCode = :promocode";

          $handle = $conn->prepare($statement);
          $handle->bindParam(':promocode', $secCode);

          $handle->execute();
          $conn = DB::close(); //CLOSE THE CONNECTION BRUH ?!
      }
      catch(\PDOExeption $ex) {
          print($ex->getMessage());
      }
  }

  function createPromocode() {
      try {
          $conn = DB::connect();

          // Secure input
          $promocode = Security::secureString($_POST["promocode"]);
          $discount = Security::secureString($_POST["discount"]);
          $startdate = Security::secureString($_POST["startdate"]);
          $enddate = Security::secureString($_POST["enddate"]);
          $numberOfUses = Security::secureString($_POST["uses"]);
          $userEmail = Security::secureString($_SESSION["UserEmail"]);

          $statement = "INSERT INTO PromoCode VALUES
                        (:PromoCode,
                        :DiscountAmount,
                        :StartDate,
                        :EndDate,
                        :NumberOfUses,
                        :UserEmail)";

          $handle = $conn->prepare($statement);
          $handle->bindParam(":PromoCode", $promocode);
          $handle->bindParam(":DiscountAmount", $discount);
          $handle->bindParam(":StartDate", $startdate);
          $handle->bindParam(":EndDate", $enddate);
          $handle->bindParam(":NumberOfUses", $numberOfUses);
          $handle->bindParam(":UserEmail", $userEmail);
          $handle->execute();

          $conn = DB::close();
      }
      catch(\PDOException $ex) {
          return print($ex->getMessage());
      }
  }
}
?>
