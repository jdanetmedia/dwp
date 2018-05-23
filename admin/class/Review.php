<?php
class Review {
  function __construct() {
    if (isset($_POST["submitdeletereview"])) {
      $this->deleteReview($_GET["removereview"]);
    }
  }

  function getReviews() {
    try {
        $conn = DB::connect();

        $statement = "SELECT * FROM Review ORDER BY ReviewID DESC";

        $handle = $conn->prepare($statement);
        $handle->execute();
        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        return $result;
    }
    catch(\PDOException $ex) {
        print($ex->getMessage());
    }
  }

  function deleteReview($id) {
    try {
        $conn = DB::connect();

        $statement = "DELETE FROM Review WHERE ReviewID = :reviewid";
        $handle = $conn->prepare($statement);
        $handle->bindParam(":reviewid", $id);
        $handle->execute();
    }
    catch(\PDOException $ex) {
        print($ex->getMessage());
    }
  }
}
?>
