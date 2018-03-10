<?php
require_once('connection.php');

function getAllPosts() {
  global $connection;

  $query = "SELECT * FROM BlogPost";

  $blogResult = mysqli_query($connection, $query);
  return $blogResult;
}

function getPost($blogID) {
  global $connection;

  $query = "SELECT * FROM BlogPost WHERE `BlogPostID` = $blogID";

  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  return $row;
}
?>
