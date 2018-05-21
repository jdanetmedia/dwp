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

  $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID";
  if (isset($_GET["cat"])) {
    if ($_GET["cat"] != "0") {
      $cat = $_GET["cat"];
      $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID WHERE `BlogCategoryID` = $cat ";
      $catResult = mysqli_query($connection, "SELECT * FROM `ProductCategory` WHERE `ProductCategoryID` = $cat");
    }
  }

  $blogResult = mysqli_query($connection, $query);
  return $blogResult;
}

function getAllRelatedPosts($categoryID, $postID) {
  global $connection;

  $query = "SELECT BlogPost.*, ImgGallery.* FROM `BlogPost` LEFT JOIN `BlogImg` ON BlogPost.BlogPostID = BlogImg.BlogPostID LEFT JOIN `ImgGallery` ON BlogImg.ImgID = ImgGallery.ImgID WHERE `BlogCategoryID` = $categoryID AND NOT BlogPost.BlogPostID = $postID";
  $blogResult = mysqli_query($connection, $query);
  return $blogResult;
}

function getPost($blogID) {
  global $connection;

  $query = "SELECT BlogPost.*, ImgGallery.ImgID, ImgGallery.URL FROM BlogPost LEFT JOIN BlogImg ON BlogImg.BlogPostID = BlogPost.BlogPostID LEFT JOIN ImgGallery ON ImgGallery.ImgID = BlogImg.ImgID WHERE BlogPost.BlogPostID = $blogID ORDER BY BlogImg.ImgID ASC";

  //$query = "SELECT * FROM BlogPost WHERE `BlogPostID` = $blogID";

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
