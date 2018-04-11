<?php
require_once('../includes/connection.php');
if (isset($_GET["cat"])) {
  if ($_GET["cat"] != "0") {
    $cat = $_GET["cat"];
    $catResult = mysqli_query($connection, "SELECT * FROM `BlogCategory` WHERE `BlogCategoryID` = $cat");
  }
}

function getAllPosts() {
  global $connection;

  $query = "SELECT * FROM `BlogPost`";
  if (isset($_GET["cat"])) {
    if ($_GET["cat"] != "0") {
      $cat = $_GET["cat"];
      $query = "SELECT * FROM `BlogPost` WHERE `BlogCategoryID` = $cat ";
      $catResult = mysqli_query($connection, "SELECT * FROM `ProductCategory` WHERE `ProductCategoryID` = $cat");
    }
  }

  $blogResult = mysqli_query($connection, $query);
  return $blogResult;
}

function getAllRelatedPosts($categoryID, $postID) {
  global $connection;

  $query = "SELECT * FROM `BlogPost` WHERE `BlogCategoryID` = $categoryID AND NOT BlogPostID = $postID";
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

function getBlogCategories() {
  global $connection;

  $prodCatResult = mysqli_query($connection, "SELECT * FROM `BlogCategory`");
  return $prodCatResult;
}

function getBlogCategory($id) {
  global $connection;

  $prodCatResult = mysqli_query($connection, "SELECT * FROM `BlogCategory` WHERE BlogCategoryID = $id");
  $row = mysqli_fetch_assoc($prodCatResult);
  return $row;
}

function getAuthor($authorEmail) {
  global $connection;

  $query = "SELECT * FROM `User` WHERE UserEmail = '{$authorEmail}'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  return $row;
}
?>
