<?php
require_once('connection.php');

function getPosts() {
  global $connection;

  $query = "SELECT * FROM BlogPost";

  $blogResult = mysqli_query($connection, $query);
  return $blogResult;
}
?>
