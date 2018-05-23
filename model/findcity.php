<?php
$q = intval($_GET['q']);
require_once('../admin/class/DB.php');
require_once('../admin/class/Security.php');
try {
  $conn = DB::connect();
  $q = Security::secureString($q);
  $statement = "SELECT * FROM ZipCode WHERE ZipCode = :zip";
  $handle = $conn->prepare($statement);
  $handle->bindParam(':zip', $q);
  $handle->execute();
  $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
  $conn = DB::close();
  foreach($result as $row) {
      echo $row['City'];
  }
}
catch(\PDOException $ex) {
  print($ex->getMessage());
}
?>
